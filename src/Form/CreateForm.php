<?php

namespace PdfImage\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Form;
use Symfony\Component\Validator\Constraints\NotNull;

class CreateForm extends FormAbstract
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
            ->add('xaxis', ChoiceType::class, [
                'label' => $piBs->trans('xaxis'),
                'required' => true,
                'choices'  => [
                    $piBs->trans('left') => 'left',
                    $piBs->trans('center') => 'center',
                    $piBs->trans('right') => 'right',
                ],
                'data' => 'left',
                'invalid_message' => $piBs->trans('not-valid'),
                'attr' => [
                    'wrapperClass' => 'col-auto mb-3',
                ],
            ])
            ->add('yaxis', ChoiceType::class, [
                'label' => $piBs->trans('yaxis'),
                'required' => true,
                'choices'  => [
                    $piBs->trans('top') => 'top',
                    $piBs->trans('center') => 'center',
                    $piBs->trans('bottom') => 'bottom',
                ],
                'data' => 'top',
                'invalid_message' => $piBs->trans('not-valid'),
                'attr' => [
                    'wrapperClass' => 'col-auto mb-3',
                ],
            ])
            ->add('orientation', ChoiceType::class, [
                'label' => $piBs->trans('orientation'),
                'required' => true,
                'choices'  => [
                    $piBs->trans('as-image') => 'image',
                    $piBs->trans('portrait') => 'p',
                    $piBs->trans('landscape') => 'l',
                ],
                'data' => 'image',
                'invalid_message' => $piBs->trans('not-valid'),
                'attr' => [
                    'wrapperClass' => 'col-auto mb-3',
                ],
            ])
            ->add('file1', FileType::class, [
                'label' => $piBs->trans('file', ['#NR#' => ' 1']),
                'required' => true,
                'constraints' => [
                    new NotNull([
                        'message' => $piBs->trans('select-file'),
                    ]),
                ],
                'attr' => [
                    'newLine' => true,
                    'wrapperClass' => 'col-12 col-md-6 col-lg-12 col-xxl-6',
                    'inputClass' => 'form-control',
                    'extAttr' => [
                        'accept' => 'image/jpeg,image/png',
                    ]
                ],
            ])
            ->add('file2', FileType::class, [
                'label' => $piBs->trans('file', ['#NR#' => ' 2']),
                'required' => false,
                'attr' => [
                    'wrapperClass' => 'col-12 col-md-6 col-lg-12 col-xxl-6 mt-3 mt-md-0 mt-lg-3 mt-xxl-0',
                    'inputClass' => 'form-control',
                    'extAttr' => [
                        'accept' => 'image/jpeg,image/png',
                    ]
                ],
            ])
            ->add('file3', FileType::class, [
                'label' => $piBs->trans('file', ['#NR#' => ' 3']),
                'required' => false,
                'attr' => [
                    'wrapperClass' => 'col-12 col-md-6 col-lg-12 col-xxl-6 mt-3',
                    'inputClass' => 'form-control',
                    'extAttr' => [
                        'accept' => 'image/jpeg,image/png',
                    ]
                ],
            ])
            ->add('file4', FileType::class, [
                'label' => $piBs->trans('file', ['#NR#' => ' 4']),
                'required' => false,
                'attr' => [
                    'wrapperClass' => 'col-12 col-md-6 col-lg-12 col-xxl-6 mt-3',
                    'inputClass' => 'form-control',
                    'extAttr' => [
                        'accept' => 'image/jpeg,image/png',
                    ]
                ],
            ])
            ->add('file5', FileType::class, [
                'label' => $piBs->trans('file', ['#NR#' => ' 5']),
                'required' => false,
                'attr' => [
                    'wrapperClass' => 'col-12 col-md-6 col-lg-12 col-xxl-6 mt-3',
                    'inputClass' => 'form-control',
                    'extAttr' => [
                        'accept' => 'image/jpeg,image/png',
                    ]
                ],
            ])
            ->add('_token', TokenType::class, [
                'required' => true,
            ])
            ->add('send', SubmitType::class, [
                'attr' => [
                    'value' => $piBs->trans('convert-pdf'),
                    'wrapperClass' => 'mt-3',
                    'inputClass' => 'btn btn-primary',
                ],
            ]);

        $form = $formBuilder->getForm();
        $form->handleRequest();
        $this->validateFiles($form, ['file1', 'file2', 'file3', 'file4', 'file5']);

        return $form;
    }
}
