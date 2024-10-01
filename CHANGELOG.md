# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [2.0.0] - 2024-10-03
### Added
- setasign/fpdi 2.6
- symfony/config 7.1
- symfony/form 7.1
- symfony/http-foundation 7.1
- symfony/mime 7.1
- symfony/security-csrf 7.1
- symfony/translation 7.1
- symfony/validator 7.1
- tecnickcom/tcpdf 6.7
- @fortawesome/fontawesome-free 6.6
- bootstrap 5.3
- [`public`](https://github.com/CodelineRed/pdf-image/blob/main/public)
- [`Form/FormAbstract.php`](https://github.com/CodelineRed/pdf-image/blob/main/src/Form/FormAbstract.php)
- [`Form/TokenType.php`](https://github.com/CodelineRed/pdf-image/blob/main/src/Form/TokenType.php)
- [`lang/de.json`](https://github.com/CodelineRed/pdf-image/blob/main/src/lang/de.json)
- [`lang/en.json`](https://github.com/CodelineRed/pdf-image/blob/main/src/lang/en.json)
- [`src/Utility.php`](https://github.com/CodelineRed/pdf-image/blob/main/src/Utility.php)
- [`composer.lock`](https://github.com/CodelineRed/pdf-image/blob/main/composer.lock)
- [`package.json`](https://github.com/CodelineRed/pdf-image/blob/main/package.json)
- [`package-lock.json`](https://github.com/CodelineRed/pdf-image/blob/main/package-lock.json)
- [`postinstall.js`](https://github.com/CodelineRed/pdf-image/blob/main/postinstall.js)
- [`constant.dist.php`](https://github.com/CodelineRed/pdf-image/blob/main/src/config/constant.dist.php)

### Changed
- application to [`src`](https://github.com/CodelineRed/pdf-image/blob/main/src)
- `Form/PdfCreate.php` to [`Form/CreateForm.php`](https://github.com/CodelineRed/pdf-image/blob/main/src/Form/CreateForm.php)
- `Form/PdfImage.php` to [`Form/ImageForm.php`](https://github.com/CodelineRed/pdf-image/blob/main/src/Form/ImageForm.php)
- `Form/PdfMerge.php` to [`Form/MergeForm.php`](https://github.com/CodelineRed/pdf-image/blob/main/src/Form/MergeForm.php)
- `css/website.css` to [`css/styles.css`](https://github.com/CodelineRed/pdf-image/blob/main/public/css/styles.css)
- `layouts/website.phtml` to [`layout/derfault.phtml`](https://github.com/CodelineRed/pdf-image/blob/main/src/view/layout/default.phtml)
- [`views/create.phtml`](https://github.com/CodelineRed/pdf-image/blob/main/src/view/image.phtml)
- [`views/merge.phtml`](https://github.com/CodelineRed/pdf-image/blob/main/src/view/image.phtml)
- [`views/index.phtml`](https://github.com/CodelineRed/pdf-image/blob/main/src/view/image.phtml)
- [`src/Bootstrap.php`](https://github.com/CodelineRed/pdf-image/blob/main/src/Bootstrap.php)
- [`screenshots`](https://github.com/CodelineRed/pdf-image/blob/main/screenshots)
- [`public/.htaccess`](https://github.com/CodelineRed/pdf-image/blob/main/public/.htaccess)
- [`public/index.php`](https://github.com/CodelineRed/pdf-image/blob/main/public/index.php)
- [`.gitignore`](https://github.com/CodelineRed/pdf-image/blob/main/.gitignore)
- [`docker-compose.yml`](https://github.com/CodelineRed/pdf-image/blob/main/docker-compose.yml)
- [`Dockerfile`](https://github.com/CodelineRed/pdf-image/blob/main/Dockerfile)
- [`README.md`](https://github.com/CodelineRed/pdf-image/blob/main/README.md)

### Removed
- Zend Framework
- constant.php
- wipe.php

## [1.2.0] - 2023-09-10
### Added
- [`controllers/ImageController.php`](https://github.com/CodelineRed/pdf-image/blob/main/application/controllers/ImageController.php)
- [`forms/PdfImage.php`](https://github.com/CodelineRed/pdf-image/blob/main/application/forms/PdfImage.php)
- [`views/image.phtml`](https://github.com/CodelineRed/pdf-image/blob/main/application/views/image.phtml)
- [`constant.php`](https://github.com/CodelineRed/pdf-image/blob/main/constant.php)

### Changed
- [`forms/PdfCreate.php`](https://github.com/CodelineRed/pdf-image/blob/main/application/forms/PdfCreate.php)
- [`forms/PdfMerge.php`](https://github.com/CodelineRed/pdf-image/blob/main/application/forms/PdfMerge.php)
- [`views/create.phtml`](https://github.com/CodelineRed/pdf-image/blob/main/application/views/create.phtml)
- [`views/merge.phtml`](https://github.com/CodelineRed/pdf-image/blob/main/application/views/merge.phtml)
- [`views/index.phtml`](https://github.com/CodelineRed/pdf-image/blob/main/application/views/index.phtml)
- [`application/Bootstrap.php`](https://github.com/CodelineRed/pdf-image/blob/main/application/Bootstrap.php)
- [`css/website.css`](https://github.com/CodelineRed/pdf-image/blob/main/files/css/website.css)
- [`screenshots`](https://github.com/CodelineRed/pdf-image/blob/main/screenshots)
- [`Zend`](https://github.com/CodelineRed/pdf-image/blob/main/Zend)
- [`.gitignore`](https://github.com/CodelineRed/pdf-image/blob/main/.gitignore)
- [`.htaccess`](https://github.com/CodelineRed/pdf-image/blob/main/.htaccess)
- [`docker-compose.yml`](https://github.com/CodelineRed/pdf-image/blob/main/docker-compose.yml)
- [`README.md`](https://github.com/CodelineRed/pdf-image/blob/main/README.md)
- [`index.php`](https://github.com/CodelineRed/pdf-image/blob/main/index.php)
- [`wipe.php`](https://github.com/CodelineRed/pdf-image/blob/main/index.php)

## [1.1.0] - 2023-04-01
### Added
- `formatFilesize()` in [`wipe.php`](https://github.com/CodelineRed/pdf-image/blob/main/wipe.php)
- [`screenshots`](https://github.com/CodelineRed/pdf-image/blob/main/screenshots)

### Changed
- german to english in [`views/error.phtml`](https://github.com/CodelineRed/pdf-image/blob/main/application/views/error.phtml)
- german to english in [`views/index.phtml`](https://github.com/CodelineRed/pdf-image/blob/main/application/views/index.phtml)
- german to english in [`application/Bootstrap.php`](https://github.com/CodelineRed/pdf-image/blob/main/application/Bootstrap.php)
- text in [`views/create.phtml`](https://github.com/CodelineRed/pdf-image/blob/main/application/views/create.phtml)
- text in [`views/merge.phtml`](https://github.com/CodelineRed/pdf-image/blob/main/application/views/merge.phtml)
- `config/uploads.ini` to [`config/docker-php.ini`](https://github.com/CodelineRed/pdf-image/blob/main/application/config/docker-php.ini)
- form styling in [`css/website.css`](https://github.com/CodelineRed/pdf-image/blob/main/files/css/website.css)
- [`docker-compose.yml`](https://github.com/CodelineRed/pdf-image/blob/main/docker-compose.yml)
- [`README.md`](https://github.com/CodelineRed/pdf-image/blob/main/README.md)

### Fixed
- filesize error in [`wipe.php`](https://github.com/CodelineRed/pdf-image/blob/main/wipe.php)