<?php

namespace PdfImage\Controller;

use PdfImage\Form\CreateForm;
use PdfImage\Model\CreateModel;
use PdfImage\Utility;

$form = (new CreateForm())->getForm();

if ($form->isSubmitted() && $form->isValid()) {
    CreateModel::generatePdf($form);
    // Utility::dunp($form->getData());
}
