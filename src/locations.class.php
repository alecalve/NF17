<?php
include_once(dirname(__FILE__).'/utils/Bdd.class.php');
include_once(dirname(__DIR__).'/conf.php');

class LocationsManager
{
    
    private $db;

    public function __construct() {
        global $_CONF;
        $this->db = new Bdd($_CONF['db_host'], $_CONF['db_name'], $_CONF['db_user'], $_CONF['db_pass']);
    }
         
    public function getDepartements() {
        $request = $this->db->prepare("SELECT * FROM tDepartements");
        $success = $this->db->execute($request, array());
        if (!$success) {
            throw new Exception("Impossible de trouver la liste des départements");
        }
        $array = $request->fetchAll(PDO::FETCH_ASSOC);
        return $array;        
    }
    
    public function getRegions() {
        $request = $this->db->prepare("SELECT * FROM tRegion");
        $success = $this->db->execute($request, array());
        if (!$success) {
            throw new Exception("Impossible de trouver la liste des régions");
        }
        $array = $request->fetchAll(PDO::FETCH_ASSOC);
        return $array;     
    }
}


