<?php
class Categorie{

    private $id;
    private $nom;
    private $couleur;
    private $icone;
    public function __construct($id,$nom,$couleur,$icone){
        $this->id=$id;
        $this->nom=$nom;
        $this->couleur=$couleur;
        $this->icone=$icone;
    }

    public function getNom(): string {
        return $this->nom;
    }
}















?>