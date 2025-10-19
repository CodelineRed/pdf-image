<?php

namespace PdfImage\Model;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use setasign\Fpdi\Tcpdf\Fpdi;

class ImageModel
{
    /**
     * Starts download of images in zip file from PDF pages
     * 
     * @param Form $form
     * @return void
     */
    static public function generateZip(Form $form): void
    {
        if (extension_loaded('imagick') && extension_loaded('zip')) {
            global $piBs;

            $data = $form->getData();
            $writeFiles = [];
            $hash = substr(md5(time()), 0, 6);
            $zip = new \ZipArchive();
            $zipPath = __DIR__ . '/../../public/Images-' . $hash . '.zip';
            $zip->open($zipPath, \ZipArchive::CREATE);
            $imagick = new \Imagick();
            $pages = $data['pages'];
            $inputFile = $data['pdf']['tmp_name'];

            $images = 0;
            $inputFileName = pathinfo($inputFile, PATHINFO_FILENAME);
            $writeFile = '';

            try {
                $pdf = new Fpdi();
                $pageCount = $pdf->setSourceFile($inputFile);

                if (empty($pages)) {
                    // is empty
                    $pages = range(1, $pageCount);
                } else if (preg_match('/^\d+-\d+$/', $pages)) {
                    // is range
                    list($from, $to) = explode('-', $pages);
                    $pages = range($from, $to);
                } else if (preg_match('/^(\d+)(,\s*\d+)*$/', $pages)) {
                    // is comma separated
                    $pages = explode(',', $pages);
                } else {
                    // is single page
                    $pages = [(int)$pages];
                }

                // iterate through selected pages
                foreach ($pages as $currentPage) {
                    if ($images === 5 && PDFIMAGE_ENV === 'prod') {
                        $form->get('pages')->addError(new FormError($piBs->trans('max-pages')));
                        break;
                    }

                    if ($currentPage > 0 && $currentPage <= $pageCount) {
                        $readFile = $inputFile . '[' . ($currentPage - 1) . ']';
                        $writeFile = __DIR__ . '/../../public/' . $inputFileName . '_' . $hash . '-' . $images . '.png';

                        if ($imagick->setResolution(250,250)) {
                            if ($imagick->readImage($readFile)) {
                                if ($imagick->writeImage($writeFile)) {
                                    $zip->addFile($writeFile, basename($writeFile));
                                    $writeFiles[] = $writeFile;
                                    $images++;
                                }
                            }
                        }
                    } else {
                        $form->get('pages')->addError(new FormError($piBs->trans('page-not-found', ['#PAGE#' => $currentPage])));
                    }
                }
            } catch (\Exception $e) {
                if (PDFIMAGE_ENV === 'dev') {
                    $form->get('pdf')->addError(new FormError($e->getMessage()));
                }

                $form->get('pdf')->addError(new FormError($piBs->trans('not-usable', ['#FILE#' => $data['pdf']['name']])));
            }

            $zip->close();

            if (count($writeFiles)) {
                foreach ($writeFiles as $writeFile) {
                    unlink($writeFile);
                }

                header('Content-Type: application/force-download');
                header('Content-Type: application/octet-stream', false);
                header('Content-Type: application/download', false);
                header("Content-type: application/zip"); 
                header("Content-Disposition: attachment; filename=" . basename($zipPath));
                header("Content-length: " . filesize($zipPath));
                header("Pragma: no-cache"); 
                header("Expires: 0"); 
                readfile($zipPath);
            }

            if (is_readable($zipPath)) {
                unlink($zipPath);
            }
        }
    }
}
