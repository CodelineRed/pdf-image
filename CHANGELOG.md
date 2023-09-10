# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.2.0]
### Added
- [`controllers/ImageController.php`](https://github.com/CodelineRed/pdf-image/blob/main/application/controllers/ImageController.php)
- [`forms/PdfImage.php`](https://github.com/CodelineRed/pdf-image/blob/main/application/forms/PdfImage.php)
- [`views/image.phtml`](https://github.com/CodelineRed/pdf-image/blob/main/application/views/image.phtml)
- [`constant.php`](https://github.com/CodelineRed/pdf-image/blob/main/constant.php)

### Changed
- [`forms/PdfCreate.php`](https://github.com/CodelineRed/pdf-image/blob/main/application/forms/PdfCreate.php)
- [`forms/PdfMerge.php`](https://github.com/CodelineRed/pdf-image/blob/main/application/forms/PdfMerge.php)
- [`views/create.phtml`](https://github.com/CodelineRed/pdf-image/blob/main/application/views/image.phtml)
- [`views/merge.phtml`](https://github.com/CodelineRed/pdf-image/blob/main/application/views/image.phtml)
- [`views/index.phtml`](https://github.com/CodelineRed/pdf-image/blob/main/application/views/image.phtml)
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