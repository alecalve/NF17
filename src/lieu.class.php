<?php
include(dirname(__FILE__).'/utils/Bdd.class.php');
include_once(dirname(__DIR__).'/conf.php');

class Lieu
{
    
    public function __construct() {
        return 0;
    }
    
    public static function getOne($name) {
		$bd = self::getDBConnection();
		$request = $bd->prepare("SELECT * FROM tLieu L WHERE L.nom=?");
		$success = $bd->execute($request, array($name));
        $array = $request->fetchAll(PDO::FETCH_ASSOC);
        $bd = NULL;
        return $array[0];
    }
    
    public static function getAll() {
		$bd = self::getDBConnection();
		$request = $bd->prepare("SELECT * FROM tLieu");
		$success = $bd->execute($request, array());
        $array = $request->fetchAll(PDO::FETCH_ASSOC);
        $bd = NULL;
        return $array;
    }
    
    private static function getDBConnection()
    {
		global $_CONF;
		
		$bd = new Bdd($_CONF['db_host'], $_CONF['db_name'], $_CONF['db_user'], $_CONF['db_pass']);
		return $bd;
    }
}
