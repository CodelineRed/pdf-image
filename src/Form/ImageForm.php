<?php

namespace PdfImage\Form;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Form;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class ImageForm extends FormAbstract
{
    /**
     * Returns an instance of Symfony Form
     * 
     * @return Form
     */
    public function getForm(): Form
    {
        global $piBs;

        $formBuilder = $this->formFactory->createBuilder()
            ->add('pages', TextType::class, [
                'label' => $piBs->trans('pages'),
                'required' => false,
                'constraints' => [
                    new Regex([
                        'pattern' => '/^(\d+|\d+-\d+|(\d+)(,\s*\d+)*)$/',
                        'message' => $piBs->trans('not-valid'),
                    ]),
                    new Callback([$this, 'validatePages']),
                ],
                'attr' => [
                    'wrapperClass' => 'col-12',
                    'inputClass' => 'form-control',
                ],
            ])
            ->add('pdf', FileType::class, [
                'label' => $piBs->trans('file', ['#NR#' => '']),
                'required' => true,
                'constraints' => [
                    new NotNull([
                        'message' => $piBs->trans('select-file'),
                    ]),
                ],
                'attr' => [
                    'newLine' => true,
                    'wrapperClass' => 'col-12 mt-3',
                    'inputClass' => 'form-control',
                ],
            ])
            ->add('_token', TokenType::class, [
                'required' => true,
            ])
            ->add('send', SubmitType::class, [
                'attr' => [
                    'value' => $piBs->trans('convert-images'),
                    'wrapperClass' => 'mt-3',
                    'disabled' => extension_loaded('imagick') && extension_loaded('zip') ? false : true,
                    'inputClass' => 'btn btn-primary',
                ],
            ]);

        $form = $formBuilder->getForm();
        $form->handleRequest();
        $this->validateFiles($form, ['pdf'], 'pdf');

        return $form;
    }

    /**
     * Validates pages field
     * 
     * @param mixed $value
     * @param ExecutionContextInterface $context
     * @param mixed $payload
     * @return void
     */
    public function validatePages(mixed $value, ExecutionContextInterface $context, mixed $payload): void
    {
        global $piBs;

        if (!empty($value)) {
            // if is range
            if (preg_match('/^\d+-\d+$/', $value)) {
                list($from, $to) = explode('-', $value);

                // if $from greater than $to or equal
                if (intval($from) >= intval($to)) {
                    $context->buildViolation($piBs->trans('not-allowed', ['#VAL#' => $value]))->addViolation();
                } else if ((intval($to) - intval($from)) + 1 > 5 && PDFIMAGE_ENV === 'prod') {
                    // if is more than 5 pages
                    $context->buildViolation($piBs->trans('5-pages', ['#VAL#' => $value]))->addViolation();
                }
            }

            // is comma separated
            if (preg_match('/^(\d+)(,\s*\d+)*$/', $value) && PDFIMAGE_ENV === 'prod') {
                // if is more than 5 pages
                if (substr_count($value, ',') > 4) {
                    $context->buildViolation($piBs->trans('5-pages', ['#VAL#' => $value]))->addViolation();
                }
            }

            // if value is lower than 1
            if (!empty($value) && (int)$value < 1) {
                $context->buildViolation($piBs->trans('not-allowed', ['#VAL#' => $value]))->addViolation();
            }
        }
    }
}
