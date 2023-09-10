<?php
class Application_Form_PdfImage extends Zend_Form
{
    function init()
    {
        $this->setMethod('post');

        $pages = new Zend_Form_Element_Text('pages');
        $pages->setLabel('Pages: (Empty = all, Single page, Range 3-5, Comma separated 5,8,1)');
        $pages->setRequired(false);
        $pages->setFilters(array('StringTrim'));
        $pages->addValidator('Regex', false, array(
            'pattern' => '/^(\d+|\d+-\d+|(\d+)(,\s*\d+)*)$/',
            'messages' => array(
                Zend_Validate_Regex::NOT_MATCH => 'Input is not valid',
            )
        ));
        $pages->addValidator('Callback', false, array(
            'callback' => function($value) {
                // if is range
                if (preg_match('/^\d+-\d+$/', $value)) {
                    list($from, $to) = explode('-', $value);
                    if (intval($from) >= intval($to)) {
                        // if $from greater than $to or equal
                        return false;
                    } else if ((intval($to) - intval($from)) + 1 > 5 && PROD) {
                        // if is more than 5 pages
                        return false;
                    }
                }

                // is comma separated
                if (preg_match('/^(\d+)(,\s*\d+)*$/', $value) && PROD) {
                    if (substr_count($value, ',') > 4) {
                        // if is more than 5 pages
                        return false;
                    }
                }
                return true;
            },
            'messages' => array(
                Zend_Validate_Callback::INVALID_VALUE => 'Input is invalid',
            )
        ));

        $srcFile = new Zend_Form_Element_File('srcfile');
        $srcFile->setLabel('File:');
        $srcFile->setRequired(TRUE);
        $srcFile->setDestination('files/pdf/input');
        $srcFile->setFilters(array('StringTrim'));
        $srcFile->setMaxFileSize(67108864); // 256MB
        $srcFile->addValidator('Extension', false, array(
            'pdf',
            'messages' => array(
                Zend_Validate_File_Extension::FALSE_EXTENSION => 'Wrong file format! Only PDF allowed',
                Zend_Validate_File_Extension::NOT_FOUND => 'File not found',
            )
        ));

        $elements[] = $pages;
        $elements[] = $srcFile;

        $elements['sub'] = new Zend_Form_Element_Submit('send');
        $elements['sub']->setLabel('Convert');
        $elements['sub']->setAttrib('onclick', 'this.value=\'Converting…\';var e=this;setTimeout(function(){e.disabled=true;},50);return true;');

        $this->addElements($elements);
        $this->setView(new Zend_View());
    }
}
