<?php
require_once 'User.php';

class Auteur extends User {
    private string $nom;
    private string $prenom;
    private string $biographie;

    public function getProfileSummary(): string {
        return "Author: {$this->nom} ({$this->email})";
    }

    public function getRoleName(): string {
        return "Auteur publié";
    }
}
?>