<?php
require_once("model/auth.php");
session_start();

if(!isLoggedIn(null))
    include ("view/not_auth.php");
else {  
    require_once("model/functions_new.php");
    $model = new dbModel();
    if(isset($_GET["action"])) {
        $action=$_GET["action"];
        switch($action) {
            case "add":
                include ("view/add_news.php");
                if(isset($_POST['submit'])) {
				$author_id = isLoggedIn("id");
                    $title = addslashes($_POST['title']);
                    $content = addslashes($_POST['content']);
                    $article_id = addslashes($model->addNews($title,$content,$author_id));
					$siteurl="http://shalashaska.h1n.ru/";
                    $uploaddir = "images/imgnews/";

                    $filenames=$_FILES['image']['name'];
                    $tmp_names=$_FILES['image']['tmp_name'];
                    $errors=$_FILES['image']['error'];
                    for( $i = 0, $length = count( $_FILES['image']['name'] ); $i < $length; $i++)
                    {
                        $ext = substr($filenames[$i], strrpos($filenames[$i],'.'), strlen($filenames[$i])-1);
                        do {
                            $filenames[$i]=uniqid();
                            $file = $uploaddir . $filenames[$i] . $ext;
                        } while (file_exists($file));
                        $max_filesize = 3145728;
                        $allowed_filetypes = array('.jpg','.JPG','.Jpg','.gif','.GIF','.Gif','.bmp','.BMP','.Bmp','.png','.PNG','.Png','.jpeg');

                        $image_src=$uploaddir.$filenames[$i];
                        if(!in_array($ext,$allowed_filetypes)) {
                            print_r('Данный формат не поддерживается.');		
							continue;
                        }
                        if(filesize($tmp_names[$i]) > $max_filesize){
                            print_r('Файл превышает допустимые значения'); 
                            continue;
                        }
                        if(!is_writable($uploaddir)) {
                            print_r('Директория закрыта от записи. обратитесь к системному администратору.'); 
                            continue;
                        }
                        echo '<pre>';
                        if (move_uploaded_file($tmp_names[$i], $image_src.$ext)) {
                            echo "Файл корректен и был успешно загружен.\n";
                        } else {
                            echo "Возможная атака с помощью файловой загрузки!\n";
                        }

                        if($err=$errors[$i]>0) 
                            die("Ошибка загрузки файла (код ошибки $err). Файл не был добавлен");

                        print "Путь к изображению: ".$siteurl.$image_src.$ext;
                        print "</pre>";
                                addslashes($model->addImage($siteurl.$image_src.$ext,$article_id));
                    }
                    //echo 'Некоторая отладочная информация: ';
                    //print_r($_FILES);
                        header("Location: cabinet.php");
                }
                break;
                
            case "edit":
                if(!isset($_GET['id']))
                    header("Location: index.php");
                $id = (int)$_GET['id'];				
				if(!$model->doesArticleBelongToMe(addslashes($_GET['id'])))
					header("Location: index.php");
                
                if(!empty($_POST) && $id>0)
                {
                    $model->editArticle($_GET['id'], $_POST['title'],$_POST['content']);
					
					$check=$_POST['del'];
					$img_id=$_POST['img_id'];
					$im = $_POST['imgs'];
					$siteurl="http://shalashaska.h1n.ru/";
					$uploaddir = "images/imgnews/";
					for($i=0; $i<$im; $i++) {
						if($check[$i]!='0')
							$model->deleteImage($img_id[$i]);
					}
                    $filenames=$_FILES['image']['name'];
                    $tmp_names=$_FILES['image']['tmp_name'];
                    $errors=$_FILES['image']['error'];
                    for( $i = 0, $length = count( $_FILES['image']['name'] ); $i < $length; $i++)
                    {
                        $ext = substr($filenames[$i], strrpos($filenames[$i],'.'), strlen($filenames[$i])-1);
                        do {
                            $filenames[$i]=uniqid();
                            $file = $uploaddir . $filenames[$i] . $ext;
                        } while (file_exists($file));
                        $max_filesize = 3145728;
                        $allowed_filetypes = array('.jpg','.JPG','.Jpg','.gif','.GIF','.Gif','.bmp','.BMP','.Bmp','.png','.PNG','.Png','.jpeg');

                        $image_src=$uploaddir.$filenames[$i];
                        if(!in_array($ext,$allowed_filetypes)) {
                            print_r('Данный формат не поддерживается.');		
							continue;
                        }
                        if(filesize($tmp_names[$i]) > $max_filesize){
                            print_r('Файл превышает допустимые значения'); 
                            continue;
                        }
                        if(!is_writable($uploaddir)) {
                            print_r('Директория закрыта от записи. обратитесь к системному администратору.'); 
                            continue;
                        }
                        echo '<pre>';
                        if (move_uploaded_file($tmp_names[$i], $image_src.$ext)) {
                            echo "Файл корректен и был успешно загружен.\n";
                        } else {
                            echo "Возможная атака с помощью файловой загрузки!\n";
                        }

                        if($err=$errors[$i]>0) 
                            die("Ошибка загрузки файла (код ошибки $err). Файл не был добавлен");

                        print "Путь к изображению: ".$image_src.$ext;
                        print "</pre>";
                                addslashes($model->addImage($siteurl.$image_src.$ext,$_GET['id']));
                    }
                    //echo 'Некоторая отладочная информация: ';
                    //print_r($_FILES);
                    header("Location: cabinet.php");
					}
                
                $article = $model->getNewsById($id);
                include("view/edit.php");
                break;
                
            case "delete":
                if(!isset($_GET['id']))
                    header("Location: index.php");
                $id=$_GET['id'];
                $model->deleteArticle($id);
                header("Location: cabinet.php");
        }
    } else
    {
        $news = $model->getGlobalNews();
        include ("view/news.php");
    }?>
	<script src="js/jquery-1.12.0.js"></script>
    <script src="js/lightbox.js"></script>
<?php
}