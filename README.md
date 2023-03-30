# PDF Image - CodelineRed

## Table of contents
- [Included Third Party Code](#included)
- Install Guides
    - [Install Main Build](#install-main-build)
    - [Install PHP (optional)](#install-php-optional)

## Included
- Zend Framework 1.11.11

## Install Main Build
### Required
- PHP 5.5 - 7.1
- GD extension

[Download zip](https://github.com/CodelineRed/pdf-image/archive/main.zip) if you don't have git on your OS.
Open console on your OS and navigate to your project folder.
```bash
$ php composer create-project codelinered/pdf-image
$ (optional) git clone https://github.com/CodelineRed/pdf-image.git
$ cd pdf-image
```

## Install PHP (optional)
### Required
- [Docker](https://www.docker.com/)

Open console on your OS and navigate to the unziped/ cloned app folder.
```bash
$ (unix)    systemctl docker start
$ (windows) "c:\path\to\Docker Desktop.exe"
$ docker-compose build
$ docker-compose up -d
```
Open [localhost:7708](http://localhost:7708) for Website.
