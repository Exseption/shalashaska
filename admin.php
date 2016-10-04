<?php
require_once("model/auth.php");
session_start();

if(!isLoggedIn(null) || isLoggedIn("user_group")!="admin")
    header("Location: index.php");
else {  
    require_once("model/functions_new.php");
    $model = new dbModel();
	$orgs = $model->getOrgs();
	
	
	include ("view/admin.php");
}