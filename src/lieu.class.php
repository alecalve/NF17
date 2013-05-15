<?php
include_once(dirname(__FILE__).'/utils/Bdd.class.php');
include_once(dirname(__DIR__).'/conf.php');

class LieuManager
{
	
	private $db;
    
    public function __construct() {
		global $_CONF;
		$this->db = new Bdd($_CONF['db_host'], $_CONF['db_name'], $_CONF['db_user'], $_CONF['db_pass']);
	}
		
		
	public function createVille($name, $couverture, $departement) {
		$request = $this->db->prepare("INSERT INTO tLieu (nom, couverture) VALUES (?, ?)");
		$success = $this->db->execute($request, array($name, $couverture));
		if (!$success) {
			throw new Exception("Échec de l'insertion dans la table lieu");
        }
		$request = $this->db->prepare("INSERT INTO tVille (fkLieu, fkDepartement) VALUES (?, ?)");
		$success = $this->db->execute($request, array($name, $couverture));
		if (!$success) {
			throw new Exception("Échec de l'insertion dans la table ville");
		}
    }
    
    public function getOne($name) {
		$request = $this->db->prepare("SELECT * FROM tLieu L WHERE L.nom=?");
		$success = $this->db->execute($request, array($name));
		if ($success) {
			$array = $request->fetchAll(PDO::FETCH_ASSOC);
			if (empty($array)) {
				$array[0] = ""; //Petit trick afin d'éviter des PHP Notice: undefined offset 0
			}
			return $array[0];
        } else {
			throw new Exception('Impossibilité de sélectionner le lieu');
        }
    }
    
    public function getAll() {
		$request = $this->db->prepare("SELECT * FROM tLieu");
		$success = $this->db->execute($request, array());
        if ($success) {
			$array = $request->fetchAll(PDO::FETCH_ASSOC);
			return $array;
        } else {
			throw new Exception('Impossibilité de sélectionner les lieux.');
        }
        return $array;
    }
}
