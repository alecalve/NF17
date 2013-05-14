<?php
include_once(dirname(__FILE__).'/utils/Bdd.class.php');
include_once(dirname(__DIR__).'/conf.php');

class Bulletin
{
    
    public function __construct() {
        return 0;
    }
    
    public static function getByLocation($name) {
		$bd = self::getDBConnection();
		$request = $bd->prepare("SELECT * FROM tBulletin B WHERE B.lieu=?");
		$success = $bd->execute($request, array($name));
        $array = $request->fetchAll(PDO::FETCH_ASSOC);
        $bd = NULL;
        if (empty($array)) {
			$array[0] = ""; //Petit trick afin d'éviter des PHP Notice: undefined offset 0
		}
        return $array[0];
    }
    
    public static function getByDate($date) {
		$bd = self::getDBConnection();
		$request = $bd->prepare("SELECT * FROM tBulletin B WHERE B.dateBulletin=?");
		$success = $bd->execute($request, array($date));
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
