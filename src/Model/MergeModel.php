<?php

namespace PdfImage\Model;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use setasign\Fpdi\Tcpdf\Fpdi;

class MergeModel
{
    /**
     * Starts download of merged PDF files
     * See: https://stackoverflow.com/a/29552294/10384360
     * 
     * @param Form $form
     * @return void
     */
    static public function generatePdf(Form $form): void
    {
        global $piBs;

        $data = $form->getData();
        $files = [
            'target' => $data['target']['tmp_name'],
            'source' => $data['source']['tmp_name'],
        ];
        $pageCount = 0;
        $pdf = new Fpdi();
        $pdf->setAutoPageBreak(false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(0, 0);

        foreach ($files as $key => $file) {
            try {
                // get the page count
                $pageCount = $pdf->setSourceFile($file);

                // iterate through all pages
                for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                    // import a page
                    $templateId = $pdf->importPage($pageNo);
                    // get the size of the imported page
                    $size = $pdf->getTemplateSize($templateId);

                    // create a page (landscape or portrait depending on the imported page size)
                    if (is_array($size)) {
                        if ($size['width'] > $size['height']) {
                            $pdf->AddPage('L', array($size['width'], $size['height']));
                        } else {
                            $pdf->AddPage('P', array($size['width'], $size['height']));
                        }
                    } else {
                        continue;
                    }

                    // use the imported page
                    $pdf->useTemplate($templateId);
                }
            } catch (\Exception $e) {
                if (PDFIMAGE_ENV === 'dev') {
                    $form->get($key)->addError(new FormError($e->getMessage()));
                }

                $form->get($key)->addError(new FormError($piBs->trans('not-usable', ['#FILE#' => $data[$key]['name']])));
                return;
            }
        }

        $hash = substr(md5(time()), 0, 6);
        $pdf->setTitle('PDFs-' . $hash . '.pdf');
        $pdf->Output('PDFs-' . $hash . '.pdf', 'D');
        die();
    }   
}
