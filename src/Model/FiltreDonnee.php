<?php

namespace App\Model;

use App\Entity\Amnities;



class FiltreDonnee {



    /** @var int */
    public $page = 1;

    /** @var string */
    public $mot = '';

    /** @var Categorie|null */
    public $categorie;

    /** @var Localite|null */
    public $ville;

    /** @var Amnities[]|null */
    public $amnities;

    // Getter and Setter methods
    public function getMot()
    {
        return $this->mot;
    }
    public function setMot($mot)
    {
        $this->mot = $mot;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    public function getVille()
    {
        return $this->ville;
    }
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    public function getAmnities()
    {
        return $this->amnities;
    }
    public function setAmnities($amnities)
    {
        $this->amnities = $amnities;
    }


    
}