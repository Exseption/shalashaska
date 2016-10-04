<!DOCTYPE HTML>
<head>
    <meta charset="utf8">
    <title>Мой кабинет</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="css/toggle-switch.css">
	<link rel="stylesheet" href="css/style.css">
	<link href="css/lightbox.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
</head>
<body>
	<?php include("view/header.php");?>
    <div class="container">
		
				<?php include("view/usrpanel.php");?>
        <div class="row navRow">
			<div class="span12">
				<div class="article">
					<div class="caption">
						<h4>Информация</h4>
						<p>Имя: <?=isLoggedIn("surname");?> <?=isLoggedIn("first_name");?>  <?=isLoggedIn("second_name");?></p>
						<p>Должность: <?=isLoggedIn("post")?> </p>
						<p>E-mail: <?=isLoggedIn("email")?> </p>
						<p>Организация:  <?=isLoggedIn("org_title")?> </p>
					</div>
				</div>
			</div>
		</div>
        
        <?php
        foreach($news as $n):
		
		if(strlen($n['content'])>500)
			$n['content']=mb_substr(mb_substr($n['content'],0,500),0,strrpos(mb_substr($n['content'],0,500),' '))."...";
        $images = $model->getImageIdByNewsId($n['article_id']);?>
        <div class="row navRow">
			<div class="span12">
				<div class="article">
					<div class="caption">
						<h3> <?=$n['title']?> </h3>
						<!--<p>Галерея:</p>-->
						<?php foreach($images as $i):?>
						<a href="<?=$model->getImageById($i['image_id']); ?>"
							 data-lightbox="<?=$n['article_id']?>"><img class="img-rounded" src="<?=$model->getImageById($i['image_id']);?>" height="100pt"></a>
						<?php endforeach ?>
						<p><?=$n['content']?></p>
						<div id="publ">Добавлено:<?=$n['publication_date']?></div>
						<?php switch($n['level']) {
							case "school" :
							?> <div id="publ">Уровень: школа</div>
							<?php break;
							case "city" :
							?> <div id="publ">Уровень: город</div>
							<?php break;
							case "area" :
							?> <div id="publ">Уровень: область</div>
							<?php break;
							case "global" :
							?> <div id="publ">Уровень: глобальный</div>
							<?php break;
							case "system" :
							?> <div id="publ">Уровень: система</div>
							<?php break;
							default: break;
						} 
						if($n['published']==1) { ?>
							<div id="publ">Опубликовано</div>
						<?php } else {?> <div id="publ">Не опубликовано</div> <?php } ?>
						<p><a class="btn btn-primary" href="selected.php?id=<?=$n['article_id']?>">Читать далее</a>
						   <a class="btn btn-primary" href="index.php?action=edit&id=<?=$n['article_id'];?>">Редактировать</a>
						   <a class="btn btn-primary" href="index.php?action=delete&id=<?=$n['article_id'];?>"
						   onclick="return confirm('Вы действительно хотите удалить эту новость?');">Удалить</a>
						   </p>
					</div>
				</div>
			</div>
		</div>
        <?php endforeach ?>
	</div>
    <?php include("view/footer.php");?>
</body>
