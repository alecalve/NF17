<?php
include_once(dirname(__FILE__).'/utils/BaseManager.class.php');

class PrevisionManager extends BaseManager
{

    public function createPluie($date, $periode, $nom, $desc, $typePreci, $hauteur, $type) {
        self::insertRequest("INSERT INTO tPrevision (datePrevision, periode, nom, description, typePrecipitation, hauteur, typePrevision) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)",
                            array($date, $periode, $nom, $desc, $typePreci, $hauteur, $type), 
                            "Échec lors de la création de la prévision");

    }
    
    public function createAutre($date, $periode, $nom, $desc, $type) {
        self::insertRequest("INSERT INTO tPrevision (datePrevision, periode, nom, description, typePrevision) 
                            VALUES (?, ?, ?, ?, ?)",
                            array($date, $periode, $nom, $desc, $type), 
                            "Échec lors de la création de la prévision");
    }
    
    public function createTemp($date, $periode, $nom, $desc, $temp, $ressenti, $type) {
        self::insertRequest("INSERT INTO tPrevision (datePrevision, periode, nom, description, temp, ressenti, typePrevision) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)",
                            array($date, $periode, $nom, $desc, $temp, $ressenti, $type), 
                            "Échec lors de la création de la prévision");

    }
    
    public function createVent($date, $periode, $nom, $desc, $force, $direction, $type) {
        self::insertRequest("INSERT INTO tPrevision (datePrevision, periode, nom, description, force, direction, typePrevision) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)",
                            array($date, $periode, $nom, $desc, $force, $direction, $type), 
                            "Échec lors de la création de la prévision");

    }
    
    public function getDirections() {
        return self::getType("typedirection", "Impossible de trouver la liste des directions");   
    }
    
    public function getPrecipitations() {
        return self::getType("typeprecipitation", "Impossible de trouver la liste des directions");   
    }
    
    /* Retourne la liste des différentes périodes du jour 
     */
    public function getPeriodes() {
        return self::getType("typeperiode", "Impossible de trouver la liste des périodes");   
    }
}

