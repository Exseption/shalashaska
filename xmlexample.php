<?php

require_once("model/functions_new.php");
    $model = new dbModel();

	//$login = $_POST['login'];
	//$password = hash('ripemd128',$_POST['password']);
	$login = "222";
	$password = hash('ripemd128',"222");
	$data = $model->logInClient($login,$password);