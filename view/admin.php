﻿<!DOCTYPE HTML>
<head>
    <meta charset="utf8">
    <title>Кабинет администратора</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include("view/header.php");?>
	
    <div class="container">
	<?php include("view/usrpanel.php");?>
	
	<table><caption>Организации</caption>
	<tr><th>ID</th><th>Наименование</th><th>Город</th><th>Район</th><th>Область</tr>
	<?php foreach ($orgs as $o): ?>
    <tr bgcolor='#f5f5f5'><td><?=$o['org_id'];?></td>
		<td><?=$o['org_title'];?></td>
        <td><?=$o['city'];?></td>
        <td><?=$o['province'];?></td>
        <td><?=$o['area'];?></td>
        <td><a href='profile.php?id=<?=$o['org_id'];?>'>Профиль <img src='images/ico/txt.ico'></a><a href='2'> Блокировать <img src='images/ico/delete.ico'></a></td></tr>
	<?php endforeach ?>
	</div>
	<?php include("view/footer.php");?>
    
</body>