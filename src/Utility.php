<?php

namespace PdfImage;

use Symfony\Component\Form\ChoiceList\View\ChoiceView;
use Symfony\Component\Form\Form;

class Utility {
    /**
     * Displays dump of $value
     * 
     * @param mixed $value
     * @return void
     */
    public static function dunp(mixed $value): void
    {
        echo '<pre>';
        print_r($value);
        echo '</pre>';
    }

    /**
     * Returns rendered input element
     * 
     * @param string $type
     * @param string $id
     * @param string $name
     * @param string $value
     * @param string $class [optional]
     * @param bool $isChecked [optional]
     * @param bool $isDisabled [optional]
     * @param bool $isReadonly [optional]
     * @return string
     */
    public static function getInput(string $type, string $id, string $name, string $value, string $class = '', bool $isChecked = false, bool $isDisabled = false, bool $isReadonly = false, $extAttr = []): string
    {
        $checked = $isChecked ? ' checked' : '';
        $disabled = $isDisabled ? ' disabled' : '';
        $readonly = $isReadonly ? ' readonly' : '';
        $extendedAttributes = '';

        if (count($extAttr)) {
            foreach ($extAttr as $attr => $value) {
                $extendedAttributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        return sprintf('<input type="%s" id="%s" name="%s" value="%s" class="%s"%s/>', $type, $id, $name, $value, $class, $checked . $disabled . $readonly . $extendedAttributes);
    }

    /**
     * Returns rendered label element
     * 
     * @param string $id
     * @param string $label
     * @param string $class [optional]
     * @return string
     */
    public static function getLabel(string $id, string $label, string $class = ''): string
    {
        return sprintf('<label for="%s" class="%s">%s</label>', $id, $class, $label);
    }

    /**
     * Sets version by version in package.json
     * 
     * @return string
     */
    public static function getVersion(): string
    {
        $version = '-';

        if (is_readable(__DIR__ . '/../composer.json')) {
            $composer = json_decode(file_get_contents(__DIR__ . '/../composer.json'), true);

            if (is_array($composer) && isset($composer['version'])) {
                $version = $composer['version'];
            }
        }

        return $version;
    }

    /**
     * Returns rendered form
     * 
     * @param Form $form
     * @return string
     */
    public static function renderForm(Form $form): string
    {
        global $piBs;

        $formView = $form->createView();
        $formErrors = $form->getErrors();
        $isFormValid = count($formErrors) === 0;
        $hasRequiredFields = false;
        $result = sprintf('<form class="row%s" enctype="multipart/form-data" action="%s" method="%s">', $isFormValid ? '' : ' is-invalid', $form->getConfig()->getAction(), $form->getConfig()->getMethod());

        foreach ($formView->getIterator() as $field) {
            $type = $field->vars['block_prefixes'][1];
            $id = $field->vars['id'];
            $filedName = substr($id, strpos($id, '_') + 1);
            $formFiledErrors = $form->get($filedName)->getErrors();
            $label = $field->vars['label'];
            $name = $field->vars['full_name'];
            $value = $field->vars['value'];
            $valid = isset($field->vars['valid']) ? $field->vars['valid'] : true;
            $data = isset($field->vars['data']) ? $field->vars['data'] : '';
            $choices = isset($field->vars['choices']) ? $field->vars['choices'] : [];
            $required = isset($field->vars['required']) ? $field->vars['required'] : false;
            $attr = isset($field->vars['attr']) ? $field->vars['attr'] : [];
            $isDisabled = !empty($attr['disabled']) ? true : false;
            $isReadonly = !empty($attr['readonly']) ? true : false;
            $isValid = $valid && count($formFiledErrors) === 0;
            $extAttr = [];

            if (!empty($attr['value'])) {
                $value = $attr['value'];
            }

            if (!empty($attr['newLine'])) {
                $result .= '<div class="col-12"></div>';
            }

            if (!empty($attr['extAttr'])) {
                $extAttr = $attr['extAttr'];
            }

            $result .= sprintf('<div class="%s">', $attr['wrapperClass'] ?? 'col-12');
            if (!empty($label)) {
                $result .= self::getLabel($id, $label, '');

                if ($required) {
                    $result .= ' *';
                    $hasRequiredFields = true;
                }

                $result .= '<br>';
            }

            if (is_array($choices) && count($choices)) {
                foreach ($choices as $choice) {
                    /* @var $choice ChoiceView */
                    $inputClass = 'form-check-input' . ($isValid ? '' : ' is-invalid') . (!empty($attr['inputClass']) ? ' ' . $attr['inputClass'] : '');
                    $labelClass = 'form-check-label' . (!empty($attr['labelClass']) ? ' ' . $attr['labelClass'] : '');
                    $checkClass = 'form-check' . ($isValid ? '' : ' is-invalid') . (!empty($attr['inputWrapperClass']) ? ' ' . $attr['inputWrapperClass'] : '');
                    $isChecked = $data === $choice->data;
                    $result .= sprintf('<div class="%s">', $checkClass);
                    $result .= self::getInput('radio', $id . '_' . $choice->data, $name, $choice->value, $inputClass, $isChecked, $isDisabled, $isReadonly, $extAttr);
                    $result .= self::getLabel($id . '_' . $choice->data, $choice->label, $labelClass);
                    $result .= '</div>';
                }
            } else {
                $inputClass = ($isValid ? '' : 'is-invalid') . (!empty($attr['inputClass']) ? ' ' . $attr['inputClass'] : '');
                $result .= self::getInput($type, $id, $name, $value, $inputClass, false, $isDisabled, $isReadonly, $extAttr);
            }

            if (!$isValid) {
                $result .= '<div class="invalid-feedback">';

                foreach ($formFiledErrors as $key => $error) {
                    $result .= $error->getMessage() . '<br>';
                }

                $result .= '</div>';
            }

            $result .= '</div>';
        }

        if ($hasRequiredFields) {
            $result .= '<div class="col mt-3">';
            $result .= '* ' . $piBs->trans('required-fields');
            $result .= '</div>';
        }

        $result .= '</form>';

        if (!$isFormValid) {
            $result .= '<div class="invalid-feedback">';

            foreach ($formErrors as $key => $error) {
                $result .= $error->getMessage() . '<br>';
            }

            $result .= '</div>';
        }

        return $result;
    }
}
