<?php
class Application_Model_Create
{
    static public function clearTempDir(array $files)
    {
        $files = glob('files/img/temp/*');
        
        if (is_array($files)) {
            foreach ($files as $filename) {
                if (file_exists($filename)) {
                    unlink($filename);
                }
            }
        }
    }
    
    static public function clearOldPdfs()
    {
        $files = glob('files/pdf/create/*');
        
        if (is_array($files)) {
            foreach ($files as $filename) {
                // if file is older than 3 minutes
                if (file_exists($filename) && time() - filemtime($filename) > 180) {
                    unlink($filename);
                }
            }
        }
    }
    
    static public function createPdf($format, $posH, $posV, array $files)
    {
        $pdf = new Zend_Pdf();
        $counter = 0;
        
        foreach ($files as $file) {
            $image = Zend_Pdf_Image::imageWithPath('files/img/temp/' . $file);
            $imageHeight = $image->getPixelHeight();
            $imageWidth = $image->getPixelWidth();

            switch ($format) {
                case 'a4h':
                    $pdf->pages[$counter] = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);

                    if ($imageWidth > 595) {
                        $prozent = 595 * 100 / $imageWidth / 100;
                        $imageWidth = $imageWidth * $prozent;
                        $imageHeight = $imageHeight * $prozent;
                    }

                    if ($imageHeight > 842) {
                        $prozent = 842 * 100 / $imageHeight / 100;
                        $imageWidth = $imageWidth * $prozent;
                        $imageHeight = $imageHeight * $prozent;
                    } 
                    break;

                case 'a4q':
                    $pdf->pages[$counter] = $pdf->newPage(Zend_Pdf_Page::SIZE_A4_LANDSCAPE);

                    if ($imageHeight > 595) {
                        $prozent = 595 * 100 / $imageHeight / 100;
                        $imageWidth = $imageWidth * $prozent;
                        $imageHeight = $imageHeight * $prozent;
                    }

                    if ($imageWidth > 842) {
                        $prozent = 842 * 100 / $imageWidth / 100;
                        $imageWidth = $imageWidth * $prozent;
                        $imageHeight = $imageHeight * $prozent;
                    }
                    break;

                default:
                    $pdf->pages[$counter] = $pdf->newPage($imageWidth . ':' . $imageHeight);
                    break;
            }
            $maxHeight = $pdf->pages[$counter]->getHeight();
            $maxWidth = $pdf->pages[$counter]->getWidth();
            
            switch ($posH) {
                case 'l':
                    $x1 = 0;
                    $x2 = $imageWidth;
                    break;
                
                case 'c':
                    $x1 = ($maxWidth / 2) - ($imageWidth / 2);
                    $x2 = ($maxWidth / 2) + ($imageWidth / 2);
                    break;
                
                case 'r':
                    $x1 = $maxWidth - $imageWidth;
                    $x2 = $maxWidth;
                    break;
                
                default:
                    $x1 = 0;
                    $x2 = $imageWidth;
                    break;
            }
            
            switch ($posV) {
                case 't':
                    $y1 = $maxHeight - $imageHeight;
                    $y2 = $maxHeight;
                    break;
                
                case 'c':
                    $y1 = ($maxHeight / 2) - ($imageHeight / 2);
                    $y2 = ($maxHeight / 2) + ($imageHeight / 2);
                    break;
                
                case 'b':
                    $y1 = 0;
                    $y2 = $imageHeight;
                    break;

                default:
                    $y1 = $maxHeight - $imageHeight;
                    $y2 = $maxHeight;
                    break;
            }

            $pdf->pages[$counter]->drawImage($image, $x1, $y1, $x2, $y2);
            $counter++;
        }
        
        $pdf->save('files/pdf/source/Image.pdf', FALSE);
        $dateKey = substr(md5(time()), 0, 6);
        copy('files/pdf/source/Image.pdf', 'files/pdf/create/Image_' . $dateKey . '.pdf');
        
        return $dateKey;
    }
    
}
