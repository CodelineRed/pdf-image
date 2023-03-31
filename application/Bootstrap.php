<?php
class Bootstrap {
    
    /**
     * Initialize the application.
     * Start the session and set error reporting.
     */
    public static function initApplication()
    {
        session_start();
        error_reporting(E_ALL);
        
        if(!isset($_SESSION['files'])) {
            $_SESSION['files'] = 1;
        }
        
        self::loadClasses();
    }
    
    /**
     * Loads classes individual.
     */
    private static function loadClasses()
    {
        require_once 'Zend/Form.php';
        require_once 'Zend/View.php';
        require_once 'Zend/Pdf.php';
        require_once 'Zend/Validate/File/Extension.php';

        self::loadClassesRekursiv('Zend/Form/Element/');
        self::loadClassesRekursiv('application/forms/');
    }
    
    /**
     * Loads classes rekursiv.
     * 
     * @param string $path 
     */
    private static function loadClassesRekursiv($path)
    {
        $handle =  opendir($path);
        while ($file = readdir($handle)) {
            if ($file != "." && $file != "..") {
                // If directory entry is a directory
                if (is_dir($path . $file)) {
                    // Another function call to read the current directory
                    self::loadClassesRekursiv($path . $file . '/');
                } else { 
                    // If directory-entry is a file, print it
                    require_once $path . $file;
                }
            }
        }
        closedir($handle);
    }
    
    /**
     * Gets the parameter from the uri.
     * 
     * @return string
     */
    public static function getParam()
    {
        $param = 'index';
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        
        foreach ($uri as $key => $value) {
            if ($uri[$key] != '' && !preg_match('@' . $uri[$key] . '@', dirname(__FILE__))) {
                $param = strtolower($uri[$key]);
                break;
            }            
        }
        
        return $param;
    }
}