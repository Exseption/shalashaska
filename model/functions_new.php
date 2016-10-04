<?php
class dbModel{

    private $link;

    public function __construct() {
        require_once('db_settings.php');
        $this->link=$this->dbConnection();
    }

    private function dbConnection() { //функция подлючения к бд
        $link = mysqli_connect(MYSQL_SERVER,MYSQL_USER,MYSQL_PASSWORD,MYSQL_DB)
        or die(mysqli_error($link));
        if(!mysqli_set_charset($link,"utf8")) {
            printf("Error: ".mysqli_error($link));
        }
    return $link;
    }
	
	public function SayHelloToDaddy() {
		$query = "SELECT token FROM users WHERE login='222'";
		$result=mysqli_query($this->link,$query)
        or die(mysqli_error($this->link));
		$t = mysqli_num_rows($result);
        $tokens = array();
		for($i = 0; $i < $t; $i++) {
            $row = mysqli_fetch_assoc($result);
			$row=$row['token'];
            $tokens[] = $row;
        }
		require_once("model/GCM.php");
		fnSendAndroid($tokens, "Слыш сука");
	}

    public function getGlobalNews() { // получаем все новости (глобальные новости)
        $query = "SELECT DISTINCT article_id,title,content,publication_date,published
        FROM articles
        WHERE published=1 AND level='global' OR level='system' 
        ORDER BY article_id DESC";
        $result=mysqli_query($this->link,$query)
        or die(mysqli_error($this->link));
        $n = mysqli_num_rows($result);
        $news = array();
        for($i = 0; $i < $n; $i++) {
            $row = mysqli_fetch_assoc($result);
            $news[] = $row;
        }
        return $news;
    }
	
	public function getAllNewsMin() {
		$query = "SELECT article_id, title, author_id, publicaion_date, published FROM articles
		ORDER BY article_id DESC";
		$result=mysqli_query($this->link,$query)
        or die(mysqli_error($this->link));
        $n = mysqli_num_rows($result);
        $articles = array();
        for($i = 0; $i < $n; $i++) {
            $row = mysqli_fetch_assoc($result);
            $articles[] = $row;
        }
        return articles;
	}
	
	public function getImagesByArticleId($id) {
		$query = "SELECT DISTINCT src FROM images WHERE article_id=$id";
		$result=mysqli_query($this->link,$query)
        or die(mysqli_error($this->link));
        $im = mysqli_num_rows($result);
        $images = array();
        for($i = 0; $i < $im; $i++) {
            $row = mysqli_fetch_assoc($result);
            $images[] = $row;
        }
        return $images;
	}
	
	public function getNewsClient($id,$hash) { // получаем все новости (глобальные новости)
        $query = "SELECT DISTINCT article_id,title,content,publication_date, first_name, surname, org_title
        FROM articles INNER JOIN (users INNER JOIN orgs on users.org_id=orgs.org_id) on users.user_id=articles.author_id
         WHERE author_id=$id AND hash='$hash'
        ORDER BY article_id DESC";
		//WHERE published=1 AND level='global'
        $result=mysqli_query($this->link,$query)
        or die(mysqli_error($this->link));
        $n = mysqli_num_rows($result);
        $news = array();
        for($i = 0; $i < $n; $i++) {
            $row = mysqli_fetch_assoc($result);
			
            $news[] = $row;
        }
        return $news;
    }
    
	public function saveToken($id,$hash,$token) { // Сохранение токена
        $query = "UPDATE users SET token='$token'
         WHERE user_id=$id AND hash='$hash'";
        $result=mysqli_query($this->link,$query)
        or die(mysqli_error($this->link));
    }
	
	public function fnDeleteToken($token) { // Удаление недействительного токена
        $query = "UPDATE users SET token='', hash=''
         WHERE token='$token'";
        $result=mysqli_query($this->link,$query)
        or die(mysqli_error($this->link));
    }
	
    public function getNewsById($news_id) {
        $user_id=isLoggedIn("id");
        if(!$user_id)
        return false;
        else
        {
            $query = "SELECT * FROM articles WHERE article_id = $news_id AND (author_id=$user_id OR level='global')";
            $result = mysqli_query($this->link,$query)
                or die(mysqli_error($this->link));
            $news = mysqli_fetch_assoc($result);
            if($news=='')
                return false;
            else
            return $news;
        }
    }
    
    public function getNewsByUserId($user_id) {
        $query = "SELECT DISTINCT article_id,title,
        content,publication_date, level, published
        FROM articles, users, orgs
        WHERE author_id=$user_id AND users.org_id=orgs.org_id
        ORDER BY article_id DESC";
        $result=mysqli_query($this->link,$query)
        or die(mysqli_error($this->link));
        $n = mysqli_num_rows($result);
        $news = array();
        for($i = 0; $i < $n; $i++){
            $row = mysqli_fetch_assoc($result);
            $news[] = $row;
        }
            return $news;
    }
    
    public function getImageIdByNewsId($article_id) {
        $query = "SELECT image_id FROM images WHERE article_id='$article_id'";
        $result = mysqli_query($this->link,$query)
            or die(mysqli_error($this->link));
        $n = mysqli_num_rows($result);
        $images=array();
        for($i = 0; $i < $n; $i++) {
            $row = mysqli_fetch_assoc($result);
            $images[] = $row;
        }
        return $images;
    }
    
    public function getImageById($id) {
        $query = "SELECT src FROM images WHERE image_id='$id'";
        $result = mysqli_query($this->link,$query)
            or die(mysqli_error($this->link));
        $src = mysqli_fetch_assoc($result);
        $src=$src['src'];
        return $src;
    }
    
    public function addNews($title,$content,$author_id) {
        $query="INSERT INTO articles(title,content,author_id,level,expiration_time) 
        values('$title','$content','$author_id','city','one')";
        $result=mysqli_query($this->link,$query)
        or die(mysqli_error($this->link));
        $id = mysqli_insert_id($this->link);
		$json = array(
		  "action" => "add",
		  "articleId" => $id
		);
		$message=json_encode( $json );
		$query="SELECT token FROM users WHERE user_id=$author_id";
		$result=mysqli_query($this->link,$query)
        or die(mysqli_error($this->link));
		$token=mysqli_fetch_assoc($result);
        $token=$token['token'];
		$tokens = array();
		$tokens[] = $token;
		require_once("model/GCM.php");
		fnSendAndroid($tokens, $message);
        return $id;
    }
	
    public function editArticle($id, $title, $content) {
        $title=trim($title);
        $conent=trim($content);
        $date=date("Y-m-d H:i:s"); 
        $id=(int)$id;
        $query = "UPDATE articles SET title='$title', content='$content', last_upd='$date' WHERE article_id=$id";
        $result = mysqli_query($this->link,$query)
            or die(mysqli_error($this->link));
		$json = array(
		  "action" => "modify",
		  "articleId" => $id
		);
		$message=json_encode( $json );
		
		$query="SELECT author_id FROM articles WHERE article_id=$id";
		$result=mysqli_query($this->link,$query)
			or die(mysqli_error($this->link));
		$author_id=mysqli_fetch_assoc($result);
        $author_id=$author_id['author_id'];
		
		$query="SELECT token FROM users WHERE user_id=$author_id";
		$result=mysqli_query($this->link,$query)
        or die(mysqli_error($this->link));
		$token=mysqli_fetch_assoc($result);
        $token=$token['token'];
		$tokens = array();
		$tokens[] = $token;
		require_once("model/GCM.php");
		fnSendAndroid($tokens, $message);
        return $id;
    }
    
    
    public function addImage($image_src,$article_id) {
        $query = "INSERT INTO images(src,article_id) values('$image_src','$article_id')";
        $result = mysqli_query($this->link,$query)
            or die(mysqli_error($this->link));
    }

    public function loggingIn($login, $password, $remember)
    {
        $query="select user_id, first_name, second_name, surname, post, email, org_title, user_group
		from users inner join orgs on users.org_id = orgs.org_id
		where login='$login' and password='$password'";
        $result=mysqli_query($this->link,$query)
        or die(mysqli_error($this->link));
        $check = mysqli_fetch_assoc($result);
        if(!empty($check['user_id'])) {
            if(!$remember) {
                session_start();
				$_SESSION['id']=$check['user_id'];
                $_SESSION['username']=$login;
				$_SESSION['first_name']=$check['first_name'];
				$_SESSION['second_name']=$check['second_name'];
				$_SESSION['surname']=$check['surname'];
				$_SESSION['post']=$check['post'];
				$_SESSION['email']=$check['email'];
				$_SESSION['org_title']=$check['org_title'];
				$_SESSION['user_group']=$check['user_group'];
            }
            else {
				setcookie('id',$check['user_id'],time()+2629800);
				setcookie('username',$login,time()+2629800);
				setcookie('first_name',$check['first_name'],time()+2629800);
				setcookie('second_name',$check['second_name'],time()+2629800);
				setcookie('surname',$check['surname'],time()+2629800);
				setcookie('post',$check['post'],time()+2629800);
				setcookie('email',$check['email'],time()+2629800);
				setcookie('org_title',$check['org_title'],time()+2629800);
				setcookie('user_group',$check['user_group'],time()+2629800);
			}
            header("Location:index.php");  
        }
        else echo "<script>alert('Неверный логин/пароль')</script>";
    }
	
	public function logInClient($login, $password) {
		$query = "SELECT user_id, hash FROM users WHERE login = \"$login\" AND password = \"$password\"";
		$result=mysqli_query($this->link,$query)
        or die(mysqli_error($this->link));
        $check = mysqli_fetch_assoc($result);
        if(!empty($check['user_id'])) {
			$check['hash'] = hash('ripemd128',microtime() . mt_rand());
			$query = "UPDATE users SET hash='".$check['hash']."' WHERE user_id=".$check['user_id'];
			$result=mysqli_query($this->link,$query)
			or die(mysqli_error($this->link));
			return $check;
		}
		else return null;
	}

    public function newUser($first_name, $second_name, $surname, $post, $email, $login, $password, $org_id) { //новый юзер
        $query = ("SELECT * FROM users WHERE login='$login'");
        $result = mysqli_query($this->link,$query)
        or die(mysqli_error($this->link));
        $check = mysqli_fetch_assoc($result);
        if(!empty($check['id'])) exit("Такой пользователь уже существует");
        $query = ("SELECT * FROM users WHERE email='$email'");
        $result = mysqli_query($this->link,$query)
        or die(mysqli_error($this->link));
        $check = mysqli_fetch_assoc($result);
        if(!empty($check['id'])) exit("Пользователь с таким E-Mail уже существует");

        $result=mysqli_query($this->link,"INSERT INTO users(first_name,second_name,surname,post,email,login,password,org_id,user_group) VALUES('$first_name','$second_name','$surname','$post','$email','$login','$password','$org_id','user')");
        if ($result=='TRUE')
        {
        exit("Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a href='index.php'>Главная страница</a>");
        }
         else {
             die(mysqli_error($this->link));
        }
    }
	
	public function getOrgs() { 
        $query="select * from orgs";
        $result=mysqli_query($this->link,$query)
        or die(mysqli_error($this->link));
        $n = mysqli_num_rows($result);
        $orgs = array();
        for($i = 0; $i < $n; $i++){
			$row = mysqli_fetch_assoc($result);
			$orgs[] = $row;
		}
        return $orgs;
    }

    public function getOrgIds() { //возвращает массив с id всех организаций
        $query="select org_id from orgs";
        $result=mysqli_query($this->link,$query)
        or die(mysqli_error($this->link));
        $n = mysqli_num_rows($result);
        $orgs = array();
        for($i = 0; $i < $n; $i++){
        $row = mysqli_fetch_assoc($result);
        $orgs[] = $row;
    }
        return $orgs;
    }

    public function orgName($org_id) //возвращает имя организации
    {
        $query = "SELECT org_title from orgs where org_id=$org_id";
        $result=mysqli_query($this->link,$query)
        or die(mysqli_error($this->link));
        $org_name = mysqli_fetch_assoc($result);
        $org_name=$org_name['org_title'];
        return $org_name;
    }
    
    public function newImageName($ext) {
        $query="select MAX(image_id) from images";
        $result=mysqli_query($this->link,$query)
        or die(mysqli_error($this->link));   
        $new_name=mysqli_fetch_assoc($result);
        $new_name=$new_name['MAX(image_id)'];
        $new_name++;
        $new_name.=$ext;
        return $new_name;
    }
    
    public function deleteArticle($id) {
        $query = "select src from images where article_id=$id";
        $result=mysqli_query($this->link,$query)
        or die(mysqli_error($this->link));   
        $n = mysqli_num_rows($result);
        $srcs = array();
        for($i = 0; $i < $n; $i++) {
            $row = mysqli_fetch_assoc($result);
            $srcs[] = $row;
        }
        foreach($srcs as $s):
		unlink("images/imgnews/".substr($s['src'],strrpos($s['src'],"/")+1,strlen($s['src'])));
        endforeach;
		
		$json = array(
		  "action" => "delete",
		  "articleId" => $id
		);
		$message=json_encode( $json );
		
		$query="SELECT author_id FROM articles WHERE article_id=$id";
		$result=mysqli_query($this->link,$query)
			or die(mysqli_error($this->link));
		$author_id=mysqli_fetch_assoc($result);
        $author_id=$author_id['author_id'];
		
		$query="SELECT token FROM users WHERE user_id=$author_id";
		$result=mysqli_query($this->link,$query)
        or die(mysqli_error($this->link));
		$token=mysqli_fetch_assoc($result);
        $token=$token['token'];
		$tokens = array();
		$tokens[] = $token;
		require_once("model/GCM.php");
		fnSendAndroid($tokens, $message);
		
        $query = "DELETE FROM `articles` WHERE `articles`.`article_id` = $id";
        $result=mysqli_query($this->link,$query)
        or die(mysqli_error($this->link)); 
    }
	
	public function deleteImage($id) {
        $query = "select src from images where image_id=$id";
        $result=mysqli_query($this->link,$query)
        or die(mysqli_error($this->link));
        $src = mysqli_fetch_assoc($result);
		$src = $src['src'];
            unlink("images/imgnews/".substr($src,strrpos($src,"/")+1,strlen($src)));
        $query = "DELETE FROM `images` WHERE `images`.`image_id` = $id";
        $result=mysqli_query($this->link,$query)
        or die(mysqli_error($this->link)); 
    }
	
	public function doesArticleBelongToMe($id) {
		$query="select author_id from articles where article_id=$id";
		$result=mysqli_query($this->link,$query)
        or die(mysqli_error($this->link));
		$author = mysqli_fetch_assoc($result);
		if($author["author_id"] == isLoggedIn("id"))
			return true;
		else return false;
	}
}