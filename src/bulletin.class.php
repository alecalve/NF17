<?php
include_once(dirname(__FILE__).'/utils/BaseManager.class.php');

/*  Gère les créations, consultations, etc.. des bulletins
 */
class BulletinManager extends BaseManager
{
    /*  Retourne la liste des bulletions pour un lieu donné
     *  Actuellement, cette méthode ne vérifie pas la date des bulletins
     */
    public function getByLocation($name) {
        $array = self::getRequest("SELECT * FROM tBulletin B WHERE B.lieu=?", array($name), "Impossible de trouver de bulletin pour ce lieu");
        if (empty($array)) {
			$array[0] = ""; //Petit trick afin d'éviter des PHP Notice: undefined offset 0
		}
        return $array[0];
    }
    
    public function getType($type, $message) {
        $query = "SELECT
                e.enumlabel AS value
                FROM pg_type t 
                JOIN pg_enum e ON t.oid = e.enumtypid  
                JOIN pg_catalog.pg_namespace n ON n.oid = t.typnamespace
                WHERE
                t.typname = ?";
        return self::getRequest($query, array($type), $message);   
    }

    public function getTypePrevision() {
        return self::getType("typeprevision", "Impossible de trouver les types de prévisions");   
    }
    
    public function getDirections() {
        return self::getType("typedirection", "Impossible de trouver les types de directions");   
    }
    
    /*  Retourne la liste des bulletins pour un date précise
     */
    public function getByDate($date) {
        return self::getRequest("SELECT * FROM tBulletin B WHERE B.dateBulletin=?", array($date), "Impossible de trouver de bulletin pour cette date");
    }
}
