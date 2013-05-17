<?php
include_once(dirname(__FILE__).'/utils/BaseManager.class.php');
include_once(dirname(__DIR__).'/conf.php');

class LocationsManager extends BaseManager
{        
    public function getDepartements() {
        return parent::getRequest("SELECT * FROM tDepartement", array(), "Impossible de trouver la liste des départements");       
    }
    
    public function getRegions() {
        return parent::getRequest("SELECT * FROM tRegion", array(), "Impossible de trouver la liste des régions");
    }
}


