<?php
include_once(dirname(__FILE__).'/utils/BaseManager.class.php');

class AlertManager extends BaseManager
{

    public function getAlerts() {
        $thresholds = array("vent" => 100, "tempHight" => 35, "tempLow" => -10, "pluie" => 100, "grêle" => 100);
        $vent = self::getRequest("SELECT * FROM tPrevision WHERE datePrevision >= current_date AND force > ?", array($thresholds["vent"]));
        $temp = self::getRequest("SELECT * FROM tPrevision WHERE datePrevision >= current_date AND (temp > ? OR temp < ?)",
                                 array($thresholds["tempHight"], $thresholds["tempLow"]));
        $preci = self::getRequest("SELECT * FROM tPrevision WHERE datePrevision >= current_date 
                                   AND (hauteur > ? AND typePrecipitation = 'pluie')
                                   OR (hauteur > ? AND typePrecipitation = 'grêle')",
                                  array($thresholds["pluie"], $thresholds["grêle"]));
        $meteor = self::getRequest("SELECT * FROM tPrevision WHERE datePrevision >= current_date AND typePrecipitation = 'météorites'");
        return array_merge($vent, $temp, $preci, $meteor);
    }
}

