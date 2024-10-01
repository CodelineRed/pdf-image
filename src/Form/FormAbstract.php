<?php

namespace PdfImage\Form;

use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\FormError;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\TokenStorage\NativeSessionTokenStorage;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validation;

abstract class FormAbstract
{
    protected $formFactory = null;
    protected $imageConstraint = null;
    protected $pdfConstraint = null;

    function __construct() {
        global $piBs;

        $csrfGenerator = new UriSafeTokenGenerator();
        $csrfStorage = new NativeSessionTokenStorage();
        $csrfManager = new CsrfTokenManager($csrfGenerator, $csrfStorage);
        $validator = Validation::createValidator();

        $this->formFactory = Forms::createFormFactoryBuilder()
            ->addExtension(new CsrfExtension($csrfManager))
            ->addExtension(new ValidatorExtension($validator))
            ->getFormFactory();

        $this->imageConstraint = new File([
            'maxSize' => '1500k',
            'maxSizeMessage' => $piBs->trans('file-max-size', ['#SIZE#' => '1.5 MB']),
            'mimeTypes' => [
                'jpeg' => 'image/jpeg',
                'png' => 'image/png',
            ],
            'mimeTypesMessage' => $piBs->trans('file-mime-type', ['#EXT#' => 'JPG/JPEG ' . $piBs->trans('and') . ' PNG']),
        ]);

        $this->pdfConstraint = new File([
            'maxSize' => '10000k',
            'maxSizeMessage' => $piBs->trans('file-max-size', ['#SIZE#' => '10 MB']),
            'mimeTypes' => [
                'pdf' => 'application/pdf',
            ],
            'mimeTypesMessage' => $piBs->trans('file-mime-type', ['#EXT#' => 'PDF']),
        ]);
    }

    /**
     * Validates file fields
     * 
     * @param Form $form
     * @param array $fields
     * @param string $constraint [optional]
     * @return void
     */
    protected function validateFiles(Form $form, array $fields, string $constraint = 'image'): void
    {
        if ($form->isSubmitted()) {
            $data = $form->getData();
            $validator = Validation::createValidator();
            $currentConstraint = $this->imageConstraint;

            if ($constraint === 'pdf') {
                $currentConstraint = $this->pdfConstraint;
            }

            // validate uploaded files
           foreach ($fields as $field) {
                if (!empty($data[$field]['tmp_name'])) {
                    $violations = $validator->validate($data[$field]['tmp_name'], $currentConstraint);

                    if (count($violations) !== 0) {
                        foreach ($violations as $violation) {
                            if ($violation instanceof ConstraintViolation) {
                                $form->get($field)->addError(new FormError($violation->getMessage()));
                            }
                        }
                    }
                }
            }
        }
    }
}
