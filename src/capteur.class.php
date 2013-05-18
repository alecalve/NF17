<?php
include_once(dirname(__FILE__).'/utils/BaseManager.class.php');

class CapteurManager extends BaseManager
{
       
    public function create($id, $type) {
        parent::insertRequest("INSERT INTO tCapteur (id, typeCapteur) VALUES (?, ?)", array($id, $type), "Échec lors de la création du capteur");
    }
    
    public function getAll() {
        $query = "SELECT C.id, C.typeCapteur, A.nom FROM tCapteur C, tAffectation A WHERE C.id=A.id AND dateFin >= current_date
                UNION
                SELECT C.id, C.typeCapteur, NULL FROM tCapteur C WHERE C.id NOT IN 
                (SELECT C.id FROM tCapteur C, tAffectation A WHERE C.id=A.id AND dateFin >= current_date);";
        return parent::getRequest($query, array(), "Impossible de trouver la liste des capteurs");     
    }
    
    public function getActive() {
        return parent::getRequest("SELECT C.id, A.nom FROM tCapteur C, tAffectation A WHERE C.id=A.id AND dateFin >= current_date;", array(), "Impossible de trouver la liste des capteurs");   
    }    
    
    public function getTypeCapteurs() {
        $query = "SELECT
                e.enumlabel AS value
                FROM pg_type t 
                JOIN pg_enum e ON t.oid = e.enumtypid  
                JOIN pg_catalog.pg_namespace n ON n.oid = t.typnamespace
                WHERE
                t.typname = ?";
        return parent::getRequest($query, array("typeprevision"), "Impossible de trouver la liste des capteurs");   
        
    }
}

