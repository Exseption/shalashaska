<?php
require_once("model/auth.php");
session_start();

if(!isLoggedIn(null))
    include ("view/not_auth.php");
else { 
    require_once("model/functions_new.php");
    $model = new dbModel();
    include('view/get_app.php'); 
} 