<?php
require_once __DIR__ . '/../../classes/GestionCategorie.php';

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

    public function createCategorie():void{
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');

        $nom = trim($_POST['nom'] ?? '');
        $couleur = trim($_POST['couleur'] ?? '');
        $icone = trim($_POST['icone'] ?? '');

        if ($nom === '' || $couleur === '' || $icone === '') {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Le nom, la couleur et l’icône sont obligatoires.'
            ]);
            return;
        }

        try {
            $categorie = new Categorie($nom, $couleur, $icone);
            $gestionCategorie = new GestionCategorie();
            $gestionCategorie->create($categorie);

            http_response_code(201);
            echo json_encode([
                'success' => true,
                'message' => 'Catégorie ajoutée avec succès.'
            ]);
        } catch (Throwable $error) {
            error_log($error->getMessage());
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Erreur lors de l’enregistrement de la catégorie.'
            ]);
        }
    }
}


$controller = new CategorieController();
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $controller->createCategorie();
} else {
    $controller->listAllCategorie();
}


?>