<?php
class Application_Form_PdfMerge extends Zend_Form
{
    function init()
    {
        $this->setMethod('post');

        $destFile = new Zend_Form_Element_File('destfile');
        $destFile->setLabel('Target file:');
        $destFile->setRequired(TRUE);
        $destFile->setDestination('files/pdf/input');
        $destFile->setFilters(array('StringTrim'));
        $destFile->setMaxFileSize(67108864); // 256MB
        $destFile->addValidator('Extension', false, array(
            'pdf',
            'messages' => array(
                Zend_Validate_File_Extension::FALSE_EXTENSION => 'Wrong file format! Only PDF allowed.',
                Zend_Validate_File_Extension::NOT_FOUND => 'File not found!'
            )
        ));

        $srcFile = new Zend_Form_Element_File('srcfile');
        $srcFile->setLabel('Source file:');
        $srcFile->setRequired(TRUE);
        $srcFile->setDestination('files/pdf/input');
        $srcFile->setFilters(array('StringTrim'));
        $srcFile->setMaxFileSize(67108864); // 256MB
        $srcFile->addValidator('Extension', false, array(
            'pdf',
            'messages' => array(
                Zend_Validate_File_Extension::FALSE_EXTENSION => 'Wrong file format! Only PDF allowed.',
                Zend_Validate_File_Extension::NOT_FOUND => 'File not found!'
            )
        ));

        $elements[] = $destFile;
        $elements[] = $srcFile;

        $elements['sub'] = new Zend_Form_Element_Submit('send');
        $elements['sub']->setLabel('Merge');
        $elements['sub']->setAttrib('onclick', 'this.value=\'Merging…\';var e=this;setTimeout(function(){e.disabled=true;},50);return true;');

        $this->addElements($elements);
        $this->setView(new Zend_View());
    }
}
