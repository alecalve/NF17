<?php
include_once(dirname(__FILE__).'/utils/Bdd.class.php');
include_once(dirname(__DIR__).'/conf.php');

class CapteurManager
{
    
    private $db;
    
    public function __construct() {
        global $_CONF;
        $this->db = new Bdd($_CONF['db_host'], $_CONF['db_name'], $_CONF['db_user'], $_CONF['db_pass']);
    }
        
        
    public function create($id, $type) {
        $request = $this->db->prepare("INSERT INTO tCapteur (id, typeCapteur) VALUES (?, ?)");
        $success = $this->db->execute($request, array($id, $type));
        if (!$success) {
            throw new Exception("Échec lors de la création du capteur");
        }
    }
    
    public function getAll() {
        $request = $this->db->prepare("SELECT * FROM tCapteur");
        $success = $this->db->execute($request, array());
        if (!$success) {
            throw new Exception("Impossible de trouver la liste des capteurs");
        }
        $array = $request->fetchAll(PDO::FETCH_ASSOC);
        return $array;        
    }
    
    public function getTypeCapteurs() {
        $request = $this->db->prepare("
            SELECT
            e.enumlabel AS value
            FROM pg_type t 
            JOIN pg_enum e ON t.oid = e.enumtypid  
            JOIN pg_catalog.pg_namespace n ON n.oid = t.typnamespace
            WHERE
            t.typname = ?");
        $success = $this->db->execute($request, array("typeprevision"));
        if (!$success) {
            throw new Exception("Impossible de trouver les types de capteurs");
        }
        $array = $request->fetchAll(PDO::FETCH_ASSOC);
        return $array;
        
    }
}

