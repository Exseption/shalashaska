<?php

require_once("model/functions_new.php");
    $model = new dbModel();
	$model->saveToken($_GET['id'],$_GET['hash'],$_GET['token']);