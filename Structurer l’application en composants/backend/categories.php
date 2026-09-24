<?php
header('Content-Type: application/json; ');
header('Access-Control-Allow-Origin: *');
$categories=[
   [ "id" => 1,"nom" => "Développement"] ,
   [ "id" => 2,"nom" => "Design UI/UX"] ,
   [ "id" => 3,"nom" => "Productivité"] 
];


echo json_encode($categories);

?>