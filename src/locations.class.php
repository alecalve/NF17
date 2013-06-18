<?php
include_once(dirname(__FILE__).'/utils/BaseManager.class.php');
include_once(dirname(__DIR__).'/conf.php');

/*  Petite classe pour avoir la liste des départements et régions
 *  Utile pour les formulaires
 */
class LocationsManager extends BaseManager
{        
    public function getDepartements() {
        return self::getRequest("SELECT * FROM tDepartement", array(), "Impossible de trouver la liste des départements");       
    }
    
    public function getRegions() {
        return self::getRequest("SELECT * FROM tRegion", array(), "Impossible de trouver la liste des régions");
    }
}


