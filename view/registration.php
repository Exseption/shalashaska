<?php $model = new dbModel();
$orgs=$model->getOrgIds();
   ?>
<!DOCTYPE html>
<head>
    <meta charset="utf8">
    <link rel="stylesheet" href="css/style.css">
    <title>Регистрация</title>
    </head>
    <body>

    <?php include("header.php");?>
    <div class="container">
    <h2>Регистрация</h2>
    <form action="registration.php" method="post">
        <p><input name="surname" type="text" size="15" maxlength="200" placeholder="Фамилия" required></p>
        <p><input name="first_name" type="text" size="15" maxlength="200" placeholder="Имя" required></p>
        <p><input name="second_name" type="text" size="15" maxlength="200" placeholder="Отчество" required></p>
        <p><input name="post" type="text" size="15" maxlength="200" placeholder="Должность"></p>
        <p><input name="email" type="email" size="15" maxlength="50" placeholder="E-mail" required></p>
        <p><input name="login" type="text" size="15" maxlength="200" placeholder="Логин" required></p>
        <p><input name="password" type="password" size="15" maxlength="200" placeholder="Пароль" required></p>
        <p><input name="password2" type="password" size="15" maxlength="200" placeholder="Подтвердите пароль" required></p>
        <p><select name="org_id" required>
            <option disabled selected>Выберите Вашу организацию</option>
            <?php foreach($orgs as $s): ?>
            <option value="<?=$s['org_id']?>"><?=$model->orgName($s['org_id'])?></option>
            <?php endforeach ?>
        </select></p>
        <p><input type="submit" name="submit" value="Зарегистрироваться"></p>
        </form>
        </div>
         <?php include("view/footer.php");?>
</body>