<!DOCTYPE HTML>
<head>
    <meta charset="utf8">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="css/toggle-switch.css">
	<link rel="stylesheet" href="css/style.css">
	<link href="css/lightbox.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <title>Войти</title>
    </head>
    <body>
	<div class="container">
		<div class="row-fluid">
			<div class="span4 offset4 text-center">
				<div class="thumbnail">
					<div class="caption">
					<h2>Войти</h2>
					<form action="login.php" method="post">
						<p><input name="login" type="text" size="15" maxlength="200" placeholder="Логин" required></p>
						<p><input name="password" type="password" size="15" maxlength="200" placeholder="Пароль" required></p>
						<!--<p><input type="checkbox" name="remember">Запомнить меня</p>-->
						<p><div class="row-fluid text-center">
							<input type="checkbox" name="remember" id="optionsCheckbox1">
							<label class="checkbox inline" for="optionsCheckbox1"><span></span>Запомнить меня</label>
						</div></p>
						<p><input type="submit" class="btn btn-success" name="enter" value="Войти"></p>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
        