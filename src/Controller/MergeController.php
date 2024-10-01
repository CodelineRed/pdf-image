<?php

namespace PdfImage\Controller;

use PdfImage\Form\MergeForm;
use PdfImage\Model\MergeModel;
use PdfImage\Utility;

$form = (new MergeForm())->getForm();

if ($form->isSubmitted() && $form->isValid()) {
    MergeModel::generatePdf($form);
    // Utility::dunp($form->getData());
}
