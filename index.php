<?php
require_once 'constant.php';
require_once 'application/Bootstrap.php';
Bootstrap::initApplication();
$page = Bootstrap::getParam();

if (file_exists('application/models/' . ucfirst($page) . 'Model.php')) {
    require_once 'application/models/' . ucfirst($page) . 'Model.php';
}

if (file_exists('application/controllers/' . ucfirst($page) . 'Controller.php')) {
    require_once 'application/controllers/' . ucfirst($page) . 'Controller.php';
}

require_once 'application/layouts/website.phtml';