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
    

    /*  Retourne la liste des bulletins pour un date précise
     */
    public function getByDate($date) {
        return self::getRequest("SELECT * FROM tBulletin B WHERE B.dateBulletin=?", array($date), "Impossible de trouver de bulletin pour cette date");
    }
}
