<?php
$pdfForm = new Application_Form_PdfImage();
$inputFiles = NULL;
$errors = [];

if (isset($_POST['send'])) {
    if ($pdfForm->isValid($_POST)) {

        $pdfForm->srcfile->receive();
        $pages = $pdfForm->pages->getValue();

        $imagick = new Imagick();
        $inputFile = 'files/pdf/input/' . $pdfForm->srcfile->getValue();

        $images = 0;
        $inputFileName = pathinfo($inputFile, PATHINFO_FILENAME);
        $dateKey = substr(md5(time()), 0, 6);
        $outputFile = '';

        $inputPdf = Zend_Pdf::load($inputFile);
        $numberOfPdfPages = 0;
        if ($inputPdf instanceof Zend_Pdf) {
            $numberOfPdfPages = count($inputPdf->pages);
        }

        if (preg_match('/^\d+-\d+$/', $pages)) {
            // is range
            list($from, $to) = explode('-', $pages);
            $pages = range($from, $to);
        } else if (preg_match('/^(\d+)(,\s*\d+)*$/', $pages)) {
            // is comma separated
            $pages = explode(',', $pages);
        } else if (empty($pages)) {
            // is empty
            $pages = range(1, $numberOfPdfPages);
        } else {
            // is single page
            $pages = [(int)$pages];
        }

        try {
            foreach ($pages as $currentPage) {
                if ($currentPage > 0 && $currentPage <= $numberOfPdfPages) {
                    if ($images === 5 && PROD) {
                        $errors[] = 'Max 5 Pages at the same time';
                        break;
                    }

                    $inputFile = 'files/pdf/input/' . $pdfForm->srcfile->getValue() . '[' . ($currentPage - 1) . ']';
                    $outputFile = 'files/pdf/image/' . $inputFileName . '_' . $dateKey . '-' . $images . '.png';
                    $reso = $imagick->setResolution(250,250);
                    $read = $imagick->readImage($inputFile);
                    $write = $imagick->writeImage($outputFile);
                    $images++;
                } else {
                    $errors[] = 'Page ' . $currentPage . ' couldn\'t be found';
                }
            }
            unlink('files/pdf/input/' . $pdfForm->srcfile->getValue());
        } catch (ImagickException $e) {
            $errors[] = $e->getMessage();
        }
    }
}
