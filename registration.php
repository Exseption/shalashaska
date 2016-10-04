<?php
require_once ("model/functions_new.php");

if (isset($_POST['submit']))
{
    if($_POST['password']==$_POST['password2'])
        {
        $model = new dbModel();
        $first_name=addslashes($_POST['first_name']);
        $second_name=addslashes($_POST['second_name']);
        $surname=addslashes($_POST['surname']);
        $post=addslashes($_POST['post']);
        $email=addslashes($_POST['email']);
        $login=addslashes($_POST['login']);
        $password=hash('ripemd128',$_POST['password']);
        $org_id=addslashes($_POST['org_id']);
        $model->newUser($first_name, $second_name, $surname, $post, $email, $login, $password, $org_id);
    }
    else exit("Введённые пароли не совпадают");
}
include ("view/registration.php");
?>