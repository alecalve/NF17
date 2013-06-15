<?php
include_once(dirname(__FILE__).'/utils/BaseManager.class.php');
include_once(dirname(__FILE__).'/Bulletin.class.php');

class PrevisionManager extends BaseManager
{
    
    public function canInsert($date, $periode, $nom, $type) {
        $prev = self::getRequest("SELECT * FROM tPrevision WHERE datePrevision = ? AND periode = ? AND nom = ? AND typeprevision = ?",
                                 array($date, $periode, $nom, $type));
        if (empty($prev)) {
            return true;
        } else {
            return false;
        }
    }
    
    private function createBulletin($date, $periode, $nom) {
        $BM = new BulletinManager();
        $bulletins = $BM->getOne($date, $periode, $nom);
        if(empty($bulletins)) {
            $BM->create($date, $periode, $nom);
        }
    }
    
    public function createPluie($date, $periode, $nom, $desc, $type) {
        if (self::canInsert($date, $periode, $nom, $type)) {
            self::createBulletin($date, $periode, $nom);
            self::insertRequest("INSERT INTO tPrevision (datePrevision, periode, nom, description, typePrevision) 
                                VALUES (?, ?, ?, ?, ?)",
                                array($date, $periode, $nom, $desc, $type), 
                                "Échec lors de la création de la prévision");
        } else {
            throw new Exception("Pas plus d’une prévision précipitations par bulletin");
        }
    }
    
    public function createAutre($date, $periode, $nom, $desc, $type) {
        self::createBulletin($date, $periode, $nom);
        self::insertRequest("INSERT INTO tPrevision (datePrevision, periode, nom, description, typePrevision) 
                            VALUES (?, ?, ?, ?, ?)",
                            array($date, $periode, $nom, $desc, $type), 
                            "Échec lors de la création de la prévision");
    }
    
    public function createTemp($date, $periode, $nom, $desc, $temp, $ressenti, $type) {
        if (self::canInsert($date, $periode, $nom, $type)) {
            self::createBulletin($date, $periode, $nom);
            self::insertRequest("INSERT INTO tPrevision (datePrevision, periode, nom, description, temp, ressenti, typePrevision) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)",
                                array($date, $periode, $nom, $desc, $temp, $ressenti, $type), 
                                "Échec lors de la création de la prévision");
        } else {
            throw new Exception("Pas plus d’une prévision température par bulletin");
        }
    }
    
    public function createVent($date, $periode, $nom, $desc, $force, $direction, $type) {
        if (self::canInsert($date, $periode, $nom, $type)) {
            self::createBulletin($date, $periode, $nom);
            self::insertRequest("INSERT INTO tPrevision (datePrevision, periode, nom, description, force, direction, typePrevision) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)",
                                array($date, $periode, $nom, $desc, $force, $direction, $type), 
                                "Échec lors de la création de la prévision");
        } else {
            throw new Exception("Pas plus d’une prévision vent par bulletin");
        }
    }

    public function getUnaffected() {
        $all =  self::getAll();
        $return = array();
        foreach($all as $capteur) {
            if ($capteur["nom"] == NULL) {
                $return[] = $capteur;
            }
        }
        return $return;
    }
    
    public function getDirections() {
        return self::getType("typedirection", "Impossible de trouver la liste des directions");   
    }
    
    /* Retourne la liste des différentes périodes du jour 
     */
    public function getPeriodes() {
        return self::getType("typeperiode", "Impossible de trouver la liste des périodes");   
    }
}

