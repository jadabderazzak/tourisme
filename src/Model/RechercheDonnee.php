<?php

namespace App\Model;

use App\Entity\Amnities;
use App\Entity\Localite;
use App\Entity\Categorie;


class RechercheDonnee {

    /** @var int */
    public $page = 1;

     /** @var string */
     public $query = '';

     /** @var Categorie|null */
     public $categorie ;

      /** @var Localite|null */
     public $ville ;
    
     public function getQuery(){
        return $this->query;
     }
     public function getCategorie(){
        return $this->categorie;
     }
     public function getVille(){
        return $this->ville;
     }

     public function setQuery($query){
        return $this->query = $query;
     }
     public function setCategorie($cat){
        return $this->categorie = $cat;
     }
     public function setVille($ville){
        return $this->ville = $ville;
     }
}