# PDF Image - CodelineRed

Take a look at [screenshots](https://github.com/CodelineRed/pdf-image/blob/main/screenshots).

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

Open console on your OS and navigate to your project folder.
Choose one of the versions below.
```bash
+++++ ZIP VERSION +++++
$ (unix) wget -O pi-main.zip https://github.com/CodelineRed/pdf-image/archive/main.zip
$ (unix) unzip pi-main.zip
$ (win10) curl -L -o pi-main.zip https://github.com/CodelineRed/pdf-image/archive/main.zip
$ (win10) tar -xf pi-main.zip
$ cd pdf-image-main
```

```bash
+++++ GIT VERSION +++++
$ git clone https://github.com/CodelineRed/pdf-image.git
$ cd pdf-image
$ git checkout main
$ (optional on unix) rm -rf .git
$ (optional on win10) rmdir .git /s
```

```bash
+++++ COMPOSER VERSION +++++
$ php composer create-project codelinered/pdf-image
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
