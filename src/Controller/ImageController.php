<?php

namespace PdfImage\Controller;

use PdfImage\Form\ImageForm;
use PdfImage\Model\ImageModel;
use PdfImage\Utility;

$form = (new ImageForm())->getForm();

if ($form->isSubmitted() && $form->isValid()) {
    ImageModel::generateZip($form);
    // Utility::dunp($form->getData);
}
