<?php

require_once("model/functions_new.php");
    $model = new dbModel();

	$login = $_POST['login'];
	$password = hash('ripemd128',$_POST['password']);
	//$login = "222";
	//$password = hash('ripemd128',"222");
	$data = $model->logInClient($login,$password);
	
	$dom = new domDocument("1.0", "utf-8");
	header("Content-Type: text/plain");
	$root = $dom->createElement("login");
	$dom->appendChild($root);
	if($data==null) {
		$confirm = $dom->createElement("confirmed");
		$root->appendChild($confirm);
		$denied = $dom->createTextNode("0");
		$confirm->appendChild($denied);
	}
	else {
		$confirm = $dom->createElement("confirmed");
		$root->appendChild($confirm);
		$granted = $dom->createTextNode("1");
		$confirm->appendChild($granted);
		
		$userId = $dom->createElement("userId");
		$root->appendChild($userId);
		$id = $dom->createTextNode($data['user_id']);
		$userId->appendChild($id);
		
		$hash = $dom->createElement("hash");
		$root->appendChild($hash);
		$text = $dom->createTextNode($data['hash']);
		$hash->appendChild($text);
	}
	
	$dom->formatOutput = true;
	
	echo $dom->saveXML();