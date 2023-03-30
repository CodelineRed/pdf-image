<?php
$pdfForm = new Application_Form_PdfMerge();
$files = NULL;

if (isset($_POST['send'])) {
    if ($pdfForm->isValid($_POST)) {
        
        $pdfForm->destfile->receive();
        $pdfForm->srcfile->receive();
        
        $files[] = $pdfForm->destfile->getValue();
        $files[] = $pdfForm->srcfile->getValue();
        
        Application_Model_Merge::clearOldPdfs();
        $dateKey = Application_Model_Merge::mergePdf($pdfForm->destfile->getValue(), $pdfForm->srcfile->getValue());
        Application_Model_Merge::clearInputDir($files);
    } 
}