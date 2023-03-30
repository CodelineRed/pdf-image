<?php
$pdfForm = new Application_Form_PdfCreate();
$files = NULL;

if (isset($_POST['add'])) {
    if ($_SESSION['files'] + 1 <= 10) {
        $_SESSION['files']++;
    }
    $pdfForm = new Application_Form_PdfCreate();
}

if (isset($_POST['del'])) {
    if ($_SESSION['files'] - 1 > 0) {
        $_SESSION['files']--;
    }
    $pdfForm = new Application_Form_PdfCreate();
}

if (isset($_POST['send'])) {
    if ($pdfForm->isValid($_POST)) {
        $member = 'file';

        for($i = 1; $i <= $_SESSION['files']; $i++){
            $var = $member . $i;
            $pdfForm->$var->receive();
            $files[] = $pdfForm->$var->getValue();
        }

        Application_Model_Create::clearOldPdfs();
        $dateKey = Application_Model_Create::createPdf($_POST['format'], $_POST['posH'], $_POST['posV'], $files);
        Application_Model_Create::clearTempDir($files);
    } 
}