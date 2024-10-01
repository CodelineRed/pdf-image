<?php
use PdfImage\Bootstrap;

define('PDFIMAGE_APP', __DIR__ . '/../src/');
define('PDFIMAGE_CONFIG', __DIR__ . '/../src/config/');
define('PDFIMAGE_FORM', __DIR__ . '/../src/Form/');
define('PDFIMAGE_MODEL', __DIR__ . '/../src/Model/');
define('PDFIMAGE_CONTROLLER', __DIR__ . '/../src/Controller/');
define('PDFIMAGE_LAYOUT', __DIR__ . '/../src/view/layout/');
define('PDFIMAGE_VIEW', __DIR__ . '/../src/view/');

require __DIR__ . '/../vendor/autoload.php';

if (is_readable(PDFIMAGE_CONFIG . 'constant.php')) {
    require_once PDFIMAGE_CONFIG . 'constant.php';
} else if (is_readable(PDFIMAGE_CONFIG . 'constant.dist.php')) {
    if (copy(PDFIMAGE_CONFIG . 'constant.dist.php', PDFIMAGE_CONFIG . 'constant.php')) {
        require_once PDFIMAGE_CONFIG . 'constant.php';
    }
}

if (!defined('PDFIMAGE_ENV')) {
    define('PDFIMAGE_ENV', 'prod');
}

if (!defined('PDFIMAGE_ERROR_REPORTING')) {
    define('PDFIMAGE_ERROR_REPORTING', 0);
}

$piBs = new Bootstrap();
$page = $piBs->getParam();

if (file_exists(PDFIMAGE_MODEL . ucfirst($page) . 'Model.php')) {
    require_once PDFIMAGE_MODEL . ucfirst($page) . 'Model.php';
}

if (file_exists(PDFIMAGE_CONTROLLER . ucfirst($page) . 'Controller.php')) {
    require_once PDFIMAGE_CONTROLLER . ucfirst($page) . 'Controller.php';
}

require_once PDFIMAGE_LAYOUT . 'default.phtml';
