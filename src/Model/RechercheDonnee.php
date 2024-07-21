<?php

namespace App\Model;

use App\Entity\Amnities;
use App\Entity\Localite;
use App\Entity\Categorie;


class RechercheDonnee {

    /** @var int */
    public $page = 1;

     /** @var string */
     public $mot = '';

     /** @var Categorie|null */
     public $categorie ;

      /** @var Localite|null */
     public $ville ;
    
     public function getMot(){
        return $this->mot;
     }
     public function getCategorie(){
        return $this->categorie;
     }
     public function getVille(){
        return $this->ville;
     }

     public function setMot($mot){
        return $this->mot = $mot;
     }
     public function setCategorie($cat){
        return $this->categorie = $cat;
     }
     public function setVille($ville){
        return $this->ville = $ville;
     }
}