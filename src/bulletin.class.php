<?php
include_once(dirname(__FILE__).'/utils/Bdd.class.php');
include_once(dirname(__DIR__).'/conf.php');

class BulletinManager
{
	
	private $db;
    
    public function __construct() {
		global $_CONF;
		$this->db = new Bdd($_CONF['db_host'], $_CONF['db_name'], $_CONF['db_user'], $_CONF['db_pass']);
	}
    
    public function getByLocation($name) {
		$request = $this->db->prepare("SELECT * FROM tBulletin B WHERE B.lieu=?");
		$success = $this->db->exec($request, array($name));
        $array = $request->fetchAll(PDO::FETCH_ASSOC);
        if (empty($array)) {
			$array[0] = ""; //Petit trick afin d'éviter des PHP Notice: undefined offset 0
		}
        return $array[0];
    }
    
    public function getByDate($date) {
		$request = $this->db->prepare("SELECT * FROM tBulletin B WHERE B.dateBulletin=?");
		$success = $this->db->execute($request, array($date));
        $array = $request->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }
}
