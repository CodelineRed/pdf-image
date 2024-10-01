<?php

namespace PdfImage\Model;

use Symfony\Component\Form\Form;
use setasign\Fpdi\Tcpdf\Fpdi;

class CreateModel
{
    const PIXEL_TO_MM = 0.2645833333;
    const MM_TO_PIXEL = 3.779527559;

    /**
     * Starts download of PDF file with images
     * 
     * @param Form $form
     * @return void
     */
    static public function generatePdf(Form $form): void
    {
        $data = $form->getData();
        $xAxis = !empty($data['xaxis']) ? $data['xaxis'] : 'left';
        $yAxis = !empty($data['yaxis']) ? $data['yaxis'] : 'top';
        $orientation = !empty($data['orientation']) ? $data['orientation'] : 'image';

        $pdf = new Fpdi(in_array($orientation, ['l', 'p']) ? $orientation : 'p');
        $pdf->setAutoPageBreak(false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(0, 0);

        for ($i = 1; $i <= 5; $i++) {
            if (!empty($data['file' . $i]['tmp_name'])) {
                $size = getimagesize($data['file' . $i]['tmp_name']);

                if (is_array($size)) {
                    $imageSizeW = round($size[0] * self::PIXEL_TO_MM, 2);
                    $imageSizeH = round($size[1] * self::PIXEL_TO_MM, 2);

                    if ($orientation === 'image') {
                        $pdf->AddPage('p', [$imageSizeW, $imageSizeH]);
                    } else {
                        $pdf->AddPage();
                    }

                    $pageW = $pdf->getPageWidth();
                    $pageH = $pdf->getPageHeight();
                    $imageDimension = self::getImageDimension($imageSizeW, $imageSizeH, $pageW, $pageH);
                    $imageW = $imageDimension['width'];
                    $imageH = $imageDimension['height'];
                    $imageX = 0;
                    $imageY = 0;

                    if ($xAxis === 'center') {
                        $imageX = ($pageW / 2) - ($imageW / 2);
                    } else if ($xAxis === 'right') {
                        $imageX = $pageW - $imageW;
                    }

                    if ($yAxis === 'center') {
                        $imageY = ($pageH / 2) - ($imageH / 2);
                    } else if ($yAxis === 'bottom') {
                        $imageY = $pageH - $imageH;
                    }

                    $pdf->Image($data['file' . $i]['tmp_name'], $imageX, $imageY, $imageW, $imageH);
                }
            }
        }

        $hash = substr(md5(time()), 0, 6);
        $pdf->setTitle('Images-' . $hash . '.pdf');
        $pdf->Output('Images-' . $hash . '.pdf', 'D');
        die();
    }

    /**
     * Returns the optimal image size
     * 
     * @param int|float $originalWidth
     * @param int|float $originalHeight
     * @param int|float $maxWidth
     * @param int|float $maxHeight
     * @return void
     */
    static public function getImageDimension($originalWidth, $originalHeight, $maxWidth, $maxHeight)
    {
        if ($originalWidth <= $maxWidth && $originalHeight <= $maxHeight) {
            $maxHeight = $originalHeight;
            $maxWidth = $originalWidth;
        } else {
            if (($originalHeight / $originalWidth) * $maxWidth <= $maxHeight) {
                $maxHeight = round(($originalHeight / $originalWidth) * $maxWidth, 1);
            } else {
                $maxWidth = round(($originalWidth / $originalHeight) * $maxHeight, 1);
            }
        }

        return [
            'width'  => $maxWidth,
            'height' => $maxHeight,
        ];
    }
}
