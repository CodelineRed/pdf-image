# PDF Image - CodelineRed

Take a look at [screenshots](https://github.com/CodelineRed/pdf-image/blob/main/screenshots).

## Table of contents
- [Included Third Party Code](#included)
- Install Guides
    - [Install Main Build](#install-main-build)
    - [Install with Docker (optional)](#install-with-docker-optional)

## Included
- Zend Framework 1.11.11 (Modified for PHP 8)

## Install Main Build
### Required
- PHP ^8.0
- GD extension
- Imagick extension

Open console on your OS and navigate to your project folder.
Choose one of the versions below.
```bash
+++++ COMPOSER VERSION +++++
$ php composer create-project codelinered/pdf-image
$ cd pdf-image
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
+++++ ZIP VERSION +++++
$ ---- Unix ----
$ wget -O pi-main.zip https://github.com/CodelineRed/pdf-image/archive/main.zip
$ unzip pi-main.zip
$ ---- Windows 10 ----
$ curl -L -o pi-main.zip https://github.com/CodelineRed/pdf-image/archive/main.zip
$ tar -xf pi-main.zip
$ --- All OS ----
$ cd pdf-image-main
```

## Install with Docker (optional)
### Required
- [Docker](https://www.docker.com/)

Open console on your OS and navigate to the place where you want to install the project.
```bash
$ ---- Unix ----
$ systemctl docker start
$ docker run --rm --interactive --tty --volume $PWD:/app composer create-project --ignore-platform-reqs codelinered/pdf-image
$ ---- Windows CMD ----
$ "c:\path\to\Docker Desktop.exe"
$ docker run --rm --interactive --tty --volume %cd%:/app composer create-project --ignore-platform-reqs codelinered/pdf-image
$ --- All OS ----
$ cd pdf-image
$ docker-compose build
$ docker-compose up -d
```
Open [localhost:7708](http://localhost:7708) for Website.
