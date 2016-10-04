<?php
require_once("model/functions_new.php");

$model = new dbModel();
if (isset($_POST['enter']))
{
    $login=addslashes($_POST['login']);
    $password=hash('ripemd128',$_POST['password']);
    if(isset($_POST['remember']))
    $model->loggingIn($login, $password, TRUE);
    else
    $model->loggingIn($login, $password, FALSE);
    
}

include("view/login.php");