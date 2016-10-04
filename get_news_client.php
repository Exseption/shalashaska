<?php

require_once("model/functions_new.php");
    $model = new dbModel();

$news = $model->getNewsClient($_GET['id'],$_GET['hash']);
	//print_r($news);
	$dom = new domDocument("1.0", "utf-8");
	header("Content-Type: text/plain");
$root = $dom->createElement("feed");

/*$xmlnsCc = $dom->createAttribute('xmlns:creativeCommons');
$xmlnsCc->value = "http://backend.userland.com/creativeCommonsRssModule";
$root->appendChild($xmlnsCc);

$xmlns = $dom->createAttribute('xmlns');
$xmlns->value = "http://www.w3.org/2005/Atom";
$root->appendChild($xmlns);*/

 $dom->appendChild($root);
 foreach($news as $n):
	$articles = $dom->createElement("article");
 $root->appendChild($articles);

 $articleId = $dom->createElement("articleId");
 $articles->appendChild($articleId);
 $text = $dom->createTextNode($n['article_id']);
 $articleId->appendChild($text);
 
 $title = $dom->createElement("title");
 $articles->appendChild($title);
 $text = $dom->createTextNode($n['title']);
 $title->appendChild($text);
 
 $content = $dom->createElement("content");
 $articles->appendChild($content);
 $text = $dom->createTextNode($n['content']);
 $content->appendChild($text);
 
 $publicationDate = $dom->createElement("publicationDate");
 $articles->appendChild($publicationDate);
 $text = $dom->createTextNode($n['publication_date']);
 $publicationDate->appendChild($text); 
 
 $author = $dom->createElement("author");
 $articles->appendChild($author);
 $text = $dom->createTextNode($n['first_name']." ".$n['surname']);
 $author->appendChild($text);
 
 $org = $dom->createElement("org");
 $articles->appendChild($org);
 $text = $dom->createTextNode($n['org_title']);
 $org->appendChild($text); 
 
 $images = $model->getImagesByArticleId($n['article_id']);
 if($images!=null) {
	for($i=0;$i<count($images);$i++){
		//print_r($images[$i]['src']);
		$imageCollection = $dom->createElement("imageCollection");
		$articles->appendChild($imageCollection);
 
		$imageSrc = $dom->createElement("imageSrc");
		$imageCollection->appendChild($imageSrc);
		$text = $dom->createTextNode($images[$i]['src']);
		$imageSrc->appendChild($text);
	}
 }
 
endforeach;
 
	$dom->formatOutput = true;
	
	echo $dom->saveXML();
	
	//$dom->save("news.xml");
	//header("Location: news.xml");
	
?>