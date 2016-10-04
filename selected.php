<?php
require_once("model/auth.php");
session_start();

if(!isLoggedIn(null))
    include ("view/not_auth.php");
else {  
    require_once("model/functions_new.php");
    $model = new dbModel();
    $news = $model->getNewsById(addslashes($_GET['id']));
    if ($news || $news['level']=='global') 
        include ("view/one_news.php");
    else
    {
        include("view/header.php");
        include("view/usrpanel.php");
        echo "Доступ к новости запрещён";

        include("view/footer.php");
    }?>

	<script src="js/jquery-1.12.0.js"></script>
    <script src="js/lightbox.js"></script>
<?php
}