<!DOCTYPE HTML>
<head>
    <meta charset="utf8">
    <title>Новостная система для школ</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="css/toggle-switch.css">
	<link rel="stylesheet" href="css/style.css">
	<link href="css/lightbox.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
</head>
<body>
<?php include("view/header.php");?>
	<div class="container">
        <?php include("view/usrpanel.php");
    $images = $model->getImageIdByNewsId($news['article_id']);?>
    <div class="row navRow">
			<div class="span12">
				<div class="article">
					<div class="caption">
						<h3> <?=$news['title']?> </h3>
						<?php foreach($images as $i):?>
						<a href="<?=$model->getImageById($i['image_id']); ?>"
							 data-lightbox="<?=$news['title']?>"><img class="img-rounded" alt="Cinque Terre"  height="150" src="<?=$model->getImageById($i['image_id']); ?>" ></a>
						<?php endforeach ?>
						<p><?=$news['content']?></p>
						<div id="publ">Опубликовано:<?=$news['publication_date']?></div>
			</div>
		</div>
    </div>
</div>
   <?php include ("view/footer.php");?>
</body>

<?php
