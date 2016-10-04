<?php
require_once("model/auth.php");
session_start();

if(!isLoggedIn(null))
    include ("view/not_auth.php");
else { 
    require_once("model/functions_new.php");
    $model = new dbModel();
    $user_id=isLoggedIn("id");
    $news = $model->getNewsByUserId($user_id);
    include('view/cabinet.php'); ?>

    <script src="js/lightbox-plus-jquery.js"></script>
<?php
} 