<?php

namespace PdfImage\Form;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Form;
use Symfony\Component\Validator\Constraints\NotNull;

class MergeForm extends FormAbstract
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
            ->add('target', FileType::class, [
                'label' => $piBs->trans('target-file'),
                'required' => true,
                'constraints' => [
                    new NotNull([
                        'message' => $piBs->trans('select-file'),
                    ]),
                ],
                'attr' => [
                    'wrapperClass' => 'col-12',
                    'inputClass' => 'form-control',
                ],
            ])
            ->add('source', FileType::class, [
                'label' => $piBs->trans('source-file'),
                'required' => true,
                'constraints' => [
                    new NotNull([
                        'message' => $piBs->trans('select-file'),
                    ]),
                ],
                'attr' => [
                    'wrapperClass' => 'col-12 mt-3',
                    'inputClass' => 'form-control',
                ],
            ])
            ->add('_token', TokenType::class, [
                'required' => true,
            ])
            ->add('send', SubmitType::class, [
                'attr' => [
                    'value' => $piBs->trans('merge-files'),
                    'wrapperClass' => 'mt-3',
                    'inputClass' => 'btn btn-primary',
                ],
            ]);

        $form = $formBuilder->getForm();
        $form->handleRequest();
        $this->validateFiles($form, ['target', 'source'], 'pdf');

        return $form;
    }
}
