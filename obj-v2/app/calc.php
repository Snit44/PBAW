<?php
require_once dirname(__FILE__).'/../config.php';
require_once _ROOT_PATH.'/app/ctrl/CalcCtrl.class.php';

$ctrl = new CalcCtrl();
$ctrl->getParams();

if ($ctrl->validate()) {
    $ctrl->process();
}

$ctrl->generateView();
?>
