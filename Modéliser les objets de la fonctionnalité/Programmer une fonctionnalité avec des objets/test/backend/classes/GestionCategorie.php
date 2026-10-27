

<?php
require_once __DIR__ . '/Categorie.php';

    class GestionCategorie {
        private static $dataFile = __DIR__ . '/../data/categories.json';

        public function getAll(): array{
            $jsondata=file_get_contents(self::$dataFile);
            $data=json_decode($jsondata,true);
            $categories=[];
            foreach($data as $item){
                $categorie=new Categorie($item['nom'],$item['couleur'],$item['icone'],$item['id']);
                $categories[]=$categorie;
            }
            return $categories;

          
        }
          public function create(Categorie $categorie): void{
            $data=json_decode(file_get_contents(self::$dataFile),true);
            $id=count($data)+1;
            $data[]=[
                "nom"=>$categorie->getNom(),
                "couleur"=>$categorie->getCouleur(),
                "icone"=>$categorie->getIcone(),
                "id"=>$id

            ];
            $json=json_encode($data,JSON_PRETTY_PRINT);
            file_put_contents(self::$dataFile,$json);
            }
            public function delete( int $id){
                $jsonData=file_get_contents(self::$dataFile);
                $data=json_decode($jsonData,true);
                $filtredData=array_filter($data, function($item) use ($id){
                    return $item["id"] !=$id;

                });
                $data=array_values($filtredData);
                $jsonData=json_encode($data,JSON_PRETTY_PRINT);
                file_put_contents(self::$dataFile,$jsonData);
            }
            public function update(Categorie $Category){
                $jsonData=file_get_contents(self::$dataFile);
                $data=json_decode($jsonData,true);
                foreach($data as &$item){
                    if ($item["id"]==$Category->getId()){
                        $item["nom"]=$Category->getNom();
                        $item["couleur"]=$Category->getCouleur();
                        $item["icone"]=$Category->getIcone();
                        break;

                    };
                    unset($item);

                    $jsonData=json_encode($data,JSON_PRETTY_PRINT);
                    file_put_contents(self::$dataFile,$jsonData);

                };
            }
            
            
    }
?>