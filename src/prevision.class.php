<?php
include_once(dirname(__FILE__).'/utils/BaseManager.class.php');

class PrevisionManager extends BaseManager
{

    public function create($id, $date, $periode, $nom, $desc, $temp, $ressenti, $force, $direction, $type) {
        self::insertRequest("INSERT INTO tPrevision (id, datePrevision, periode, nom, description, temp, ressenti, force, direction, typePrevision) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
                            array($id, $date, $periode, $nom, $desc, $temp, $ressenti, $force, $direction, $type), 
                            "Échec lors de la création de la prévision");
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
    
    /* Retourne la liste des différentes périodes du jour 
     */
    public function getPeriodes() {
        $query = "SELECT
                e.enumlabel AS value
                FROM pg_type t 
                JOIN pg_enum e ON t.oid = e.enumtypid  
                JOIN pg_catalog.pg_namespace n ON n.oid = t.typnamespace
                WHERE
                t.typname = ?";
        return self::getRequest($query, array("typeperiode"), "Impossible de trouver la liste des périodes");   
    }
}

