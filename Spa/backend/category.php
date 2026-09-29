
<?php 

class category {
    private int  $id;
    private string $nom;
    private string $couleur;
    private string $icone;

    public function __construct( int $id, string $nom, string $couleur, string $icone) 
    {
        $this->nom=$nom;
        $this->id=$id;
        $this->couleur=$couleur;
        $this->icone=$icone;

    } 
    // getters 
     public function getId(): int {
        return $this->id;
    }
    public function getNom(): string {
        return $this->nom;
    }
  
    public function getCouleur(): string {
        return $this->couleur;
    }
    public function getIcone(): string {
        return $this->icone;
    }

    //  setters 

    public function setNom(string $newName): void {
        if(strlen($newName)>2){
            $this->nom=$newName;
        }
        else{
            echo "erreur name is too short";
        }
    }
    public function setCouleur(string $newColor): void {
        if(strtolower($newColor)!=strtolower($this->couleur)){
            $this->couleur=$newColor;
        }
        else{
            echo "vous avez choisr le meme couleur ";
        }
    }
    public function setIcone(string $newIcone): void {
        if(strtolower($newIcone)!=strtolower($this->icone)){
            $this->icone=$newIcone;
        }
        else{
            echo "vous avez choisr le meme icoone ";
        }
    }


    




    public function afficher(){
        echo "le category est ".$this->nom." - ".$this->couleur." - ".$this->icone ;
    }

}


?>