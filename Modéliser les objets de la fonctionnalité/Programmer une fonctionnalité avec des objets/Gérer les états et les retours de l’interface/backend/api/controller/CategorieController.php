<?php
require_once __DIR__ . '../../../classes/GestionCategorie.php';

class CategorieController{
    public function listAllCategorie():void{
        $gestionCategorie = new GestionCategorie();
        $categories = $gestionCategorie->getAll();

        $data=[];
        foreach($categories as $categorie){
            $data[]=[
                "nom"=>$categorie->getNom(),
                "couleur"=>$categorie->getCouleur(),
                "icone"=>$categorie->getIcone(),
                "id"=>$categorie->getId()
            ];

            
        }
        
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
    
        echo json_encode($data);
        }
}


$controller = new CategorieController();
$controller->listAllCategorie();


?>