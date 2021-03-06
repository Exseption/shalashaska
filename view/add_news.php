<!DOCTYPE html>
<head>
    <meta charset="utf8">
    <title>Добавить новость</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="css/toggle-switch.css">
	<link rel="stylesheet" href="css/style.css">
	<link href="css/lightbox.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    
    <script type="text/javascript">
 
// Объект "нэймспейса"
var uploader = uploader || {};
        fileFields=0;
 
// Функция "Удалить поле"
uploader.delfield  = function (obj) {   
    obj.onclick = null;
    obj.parentNode.parentNode.removeChild(obj.parentNode);  
    fileFields--;
}
 
// Функция "Добавить поле"
uploader.addfield  = function (GLOB) {  
    if(fileFields >= 10) alert("Нельзя добавить больше 10 файлов");
    else {
        /* 
         * Здесь код формирует очередное поле загрузки файла,
         * т.е. html код элементов, эквивалентный следующему:
         *   
         * <p>
         *      <input name="file[]" type="file" size="30" />
         *      <button type="button" onclick="uploader.delfield(this)">DEL</button>
         * </p>
         * 
         * Только обработчик onclick назначиться чуть по - другому.
         */    
      var DOC            = GLOB.document,
          wrapper        = DOC.getElementById("filewrapper"),
          htmlP          = DOC.createElement("P"),
          htmlInput      = DOC.createElement("INPUT"),
          htmlButton     = DOC.createElement("BUTTON"),
          htmlButtonText = DOC.createTextNode("Удалить");

      htmlInput.name     = "image[]";
      htmlInput.type     = "file";
      htmlInput.size     = "30";

      htmlButton.onclick = function() { uploader.delfield(htmlButton) };    

      // Добавляем всё это хозяйство в DOM дерево документа:
      wrapper.appendChild(htmlP);
      htmlP.appendChild(htmlInput);
      htmlP.appendChild(htmlButton);
      htmlButton.appendChild(htmlButtonText);   
        fileFields++;
    }
}
</script>
    
</head>
<body>
	<?php include("view/header.php");?>
	<div class="container">
        <?php include("view/usrpanel.php");?>
        <div class="row navRow">
			<div class="span12">
				<div class="article">
					<div class="caption">
						<h2>Добавить новость</h2>
						<form action="index.php?action=<?=$_GET['action'];?>&id=<?=$_GET['id'];?>" method="post" enctype="multipart/form-data">
							<p>Название:</p>
							<p><input name="title" type="text" size="30" maxlength="200" required></p>
							<p>Содержание:</p>
							<p><textarea name="content" cols=300 rows=10 required></textarea></p>
							
							<p>Загрузить изображения для новости:</p>
							<div id="filewrapper">
							<input type="hidden" name="MAX_FILE_SIZE" value="3145728" />
							</div>
							<p> <button type="button" class="btn btn-primary" onclick="uploader.addfield(window)">Добавить файл</button>
								<input type="submit" class="btn btn-success" name="submit" value="Добавить новость"></p>
						</form>
					</div>
				</div>
			</div>
		</div>
    </div>
	<?php include("view/footer.php");?>
</body>
