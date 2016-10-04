<?php 
function isLoggedIn($info) { //проверка, вошёл ли пользователь. Если да, возвращает его логин. Если нет - false
        if(!isset($_COOKIE['id'])) {
            if(!isset($_SESSION['id']))
              return false;
            else 
				switch($info) {
					case "id":
						return $_SESSION['id'];
						break;
					case "username":
						return $_SESSION['username'];
						break;
					case "first_name":
						return $_SESSION['first_name'];
						break;
					case "second_name":
						return $_SESSION['second_name'];
						break;
					case "surname":
						return $_SESSION['surname'];
						break;
					case "post":
						return $_SESSION['post'];
						break;
					case "email":
						return $_SESSION['email'];
						break;
					case "org_title":
						return $_SESSION['org_title'];
						break;
					case "user_group":
						return $_SESSION['user_group'];
						break;
					default: 
						return true;
						break;
				}
                return true;
        }
        else
            switch($info) {
					case "id":
						return $_COOKIE['id'];
						break;
					case "username":
						return $_COOKIE['username'];
						break;
					case "first_name":
						return $_COOKIE['first_name'];
						break;
					case "second_name":
						return $_COOKIE['second_name'];
						break;
					case "surname":
						return $_COOKIE['surname'];
						break;
					case "post":
						return $_COOKIE['post'];
						break;
					case "email":
						return $_COOKIE['email'];
						break;
					case "org_title":
						return $_COOKIE['org_title'];
						break;
					case "user_group":
						return $_COOKIE['user_group'];
						break;
					default: 
						return true;
						break;
				}
    } 
