<?php
require_once "category.php";


$category=new category(1,"science","blue","Xjbd");
echo "le nom de category est : ".$category->getNom()."<br>";

echo "le Couleur de category est : ".$category->getCouleur()."<br>";
$category->setCouleur("red");
echo "le Couleur de category apres le changment est  : ".$category->getCouleur();




?>