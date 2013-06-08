<?php
include_once(dirname(__FILE__).'/utils/BaseManager.class.php');

/*  Gère les créations, consultations, etc.. des bulletins
 */
class BulletinManager extends BaseManager
{
    
    public function create($date, $periode, $lieu) {
        self::insertRequest("INSERT INTO tBulletin (dateBulletin, periode, lieu) VALUES (?, ?, ?)", array($date, $periode, $lieu),
                            "Échec lors de la création du bulletin");
    }
    
    /*  Retourne la liste des bulletins pour un lieu donné
     */
    public function getByLocation($lieu) {
        return self::getRequest("SELECT * FROM tBulletin WHERE lieu=? ORDER BY dateBulletin, periode DESC", array($lieu), 
                                "Impossible de trouver de bulletins pour ce lieu");
        
    }
    
    public function getPrevisions($lieu, $date, $periode) {
        return self::getRequest("SELECT * FROM tPrevision WHERE nom=? AND datePrevision=? AND periode=? ORDER BY datePrevision, periode DESC", array($lieu, $date, $periode), 
                                "Impossible de trouver les prévisions de ce bulletin");
    }
    
    public function getAll() {
        return self::getRequest("SELECT * FROM tBulletin", array(), "Impossible de trouver les bulletins");
    }
}
