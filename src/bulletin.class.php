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
        $old = self::getRequest("SELECT * FROM tBulletin WHERE lieu=? AND dateBulletin < current_date", array($lieu), 
                                "Impossible de trouver de bulletins pour ce lieu");
        $today = self::getRequest("SELECT * FROM tBulletin WHERE lieu=? AND dateBulletin = current_date", array($lieu), 
                                "Impossible de trouver de bulletins pour ce lieu");
        $future = self::getRequest("SELECT * FROM tBulletin WHERE lieu=? AND dateBulletin > current_date", array($lieu), 
                                "Impossible de trouver de bulletins pour ce lieu");
        return array("old" => $old, "today" => $today, "future" => $future);
        
    }
    
    public function getPrevisions($lieu, $date, $periode) {
        return self::getRequest("SELECT * FROM tPrevision WHERE nom=? AND datePrevision=? AND periode=?", array($lieu, $date, $periode), 
                                "Impossible de trouver les prévisions de ce bulletin");
    }
    
    public function getAll() {
        return self::getRequest("SELECT * FROM tBulletin", array(), "Impossible de trouver les bulletins");
    }
}
