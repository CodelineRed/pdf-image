<?php
class Application_Form_PdfCreate extends Zend_Form
{
    function init()
    {
        $this->setMethod('post');

        $posH = new Zend_Form_Element_Radio('posH');
        $posH->setLabel('Position Horizontal:');
        $posH->setMultiOptions(array(
            'l' => 'left',
            'c' => 'center',
            'r' => 'right',
        ));
        $posH->setValue('l');
        $elements['posH'] = $posH;

        $posV = new Zend_Form_Element_Radio('posV');
        $posV->setLabel('Position Vertikal:');
        $posV->setMultiOptions(array(
            't' => 'top',
            'c' => 'center',
            'b' => 'bottom',
        ));
        $posV->setValue('t');
        $elements['posV'] = $posV;

        $format = new Zend_Form_Element_Radio('format');
        $format->setLabel('Format:');
        $format->setMultiOptions(array(
            'image' => 'same as Image',
            'a4h'   => 'DIN A4 portrait',
            'a4q'   => 'DIN A4 landscape',
        ));
        $format->setValue('image');
        $elements['format'] = $format;

        $elements['addbtn'] = new Zend_Form_Element_Submit('add');
        $elements['addbtn']->setLabel('+ File');

        $elements['delbtn'] = new Zend_Form_Element_Submit('del');
        $elements['delbtn']->setLabel('- File');

        for($i = 1; $i <= $_SESSION['files']; $i++) {
            $file = new Zend_Form_Element_File('file' . $i);
            $file->setLabel('File ' . $i . ':');
            $file->setRequired(TRUE);
            $file->setDestination('files/img/temp');
            $file->setFilters(array('StringTrim'));
            $file->setMaxFileSize(67108864); // 256MB
            $file->addValidator('Extension', false, array(
                'jpg,png',
                'messages' => array(
                    Zend_Validate_File_Extension::FALSE_EXTENSION => 'Wrong file format! Only jpg and png allowed.',
                    Zend_Validate_File_Extension::NOT_FOUND => 'File not found!'
                )
            ));
            $elements[$i] = $file;
        }

        $elements['sub'] = new Zend_Form_Element_Submit('send');
        $elements['sub']->setLabel('Create');
        $elements['sub']->setAttrib('onclick', 'this.value=\'Creating...\';var e=this;setTimeout(function(){e.disabled=true;},50);return true;');

        $this->addElements($elements);
        $this->setView(new Zend_View());
    }
}
