<?php
include_once(dirname(__FILE__).'/utils/BaseManager.class.php');

class BulletinManager extends BaseManager
{
    
    public function getByLocation($name) {
        $array = parent::getRequest("SELECT * FROM tBulletin B WHERE B.lieu=?", array($name), "Impossible de trouver de bulletin pour ce lieu");
        if (empty($array)) {
			$array[0] = ""; //Petit trick afin d'éviter des PHP Notice: undefined offset 0
		}
        return $array[0];
    }
    
    public function getByDate($date) {
        return parent::getRequest("SELECT * FROM tBulletin B WHERE B.dateBulletin=?", array($date), "Impossible de trouver de bulletin pour cette date");
    }
}
