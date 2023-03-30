<?php
class Application_Model_Merge
{
    static public function clearInputDir(array $files)
    {
        $files = glob('files/pdf/input/*');
        
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
        $files = glob('files/pdf/merge/*');
        
        if (is_array($files)) {
            foreach ($files as $filename) {
                // if file is older than 3 minutes
                if (file_exists($filename) && time() - filemtime($filename) > 180) {
                    unlink($filename);
                }
            }
        }
    }
    
    static public function mergePdf($dest, $source)
    {
        $destPdf = Zend_Pdf::load('files/pdf/input/' . $dest);
        $sourcePdf = Zend_Pdf::load('files/pdf/input/' . $source);
                
        $count = count($sourcePdf->pages);
        
        for ($i = 0; $i < $count; $i++) {
            $destPdf->pages[] = clone $sourcePdf->pages[$i];
        }
        
        $destPdf->save('files/pdf/input/' . $dest, TRUE);
        $dateKey = substr(md5(time()), 0, 6);
        copy('files/pdf/input/' . $dest, 'files/pdf/merge/PDF_' . $dateKey . '.pdf');
        
        return $dateKey;
    }
    
}
