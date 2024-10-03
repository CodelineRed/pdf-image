# PDF Image - CodelineRed

Take a look at [screenshots](https://github.com/CodelineRed/pdf-image/blob/main/screenshots).

[**Demo page**](https://pi.codelinered.net)

## Table of contents
- [Included Third Party Code](#included)
- Install Guides
    - [Install Main Build](#install-main-build)
    - [Install with Docker (optional)](#install-with-docker-optional)

## Included
- [Bootstrap 5.3](https://getbootstrap.com)
- [Font Awesome 6.6](https://fontawesome.com)
- [FPDI 2.6](https://packagist.org/packages/setasign/fpdi)
- [TCPDF 6.7](https://packagist.org/packages/tecnickcom/tcpdf)
- Parts of [Symfony 7.1](https://symfony.com)
  - Form
  - Translation
  - Validator

## Install Main Build
### Required
- PHP ^8.2
- PHP GD extension

### Optional
- [Node.js](http://nodejs.org/en/download/) >=18.0
- [npm](http://www.npmjs.com/get-npm) `npm i npm@latest -g`
- PHP Imagick extension
- PHP ZIP extension

Open console on your OS and navigate to your project folder.
Choose one of the versions below.

### With Composer
```shell
php composer create-project codelinered/pdf-image && cd pdf-image
```

### With GIT
```shell
git clone https://github.com/CodelineRed/pdf-image.git && cd pdf-image && git checkout main
```

### With ZIP
Unix
```shell
wget -O pi-main.zip https://github.com/CodelineRed/pdf-image/archive/main.zip && unzip pi-main.zip && cd pdf-image-main
```

Windows 10+
```shell
curl -L -o pi-main.zip https://github.com/CodelineRed/pdf-image/archive/main.zip && tar -xf pi-main.zip && cd pdf-image-main
```

## Install with Docker (optional)
### Required
- [Docker](https://www.docker.com)

Open console on your OS and navigate to the place where you want to install the project.

Unix
- Start Docker `systemctl docker start`
- Copy and run commands below
```shell
docker run --rm --interactive --tty --volume $PWD:/app composer create-project --ignore-platform-reqs codelinered/pdf-image && cd pdf-image && docker-compose build && docker-compose up -d && xdg-open http://localhost:7708
```

Windows 10+
- Start Docker Desktop `"C:\Program Files\Docker\Docker Desktop.exe"`
- Copy and run commands below
```shell
docker run --rm --interactive --tty --volume %cd%:/app composer create-project --ignore-platform-reqs codelinered/pdf-image && cd pdf-image && docker-compose build && docker-compose up -d && start http://localhost:7708
```

Open [localhost:7708](http://localhost:7708) for Website.
