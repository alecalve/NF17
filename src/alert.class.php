<?php
include_once(dirname(__FILE__).'/utils/BaseManager.class.php');

class AlertManager extends BaseManager
{

    public function getAlerts() {
        $thresholds = array("vent" => 100, "tempHight" => 35, "tempLow" => -10);
        $vent = self::getRequest("SELECT * FROM tPrevision WHERE datePrevision >= current_date AND force > ?", array($thresholds["vent"]));
        $temp = self::getRequest("SELECT * FROM tPrevision WHERE datePrevision >= current_date AND (temp > ? OR temp < ?)",
                                 array($thresholds["tempHight"], $thresholds["tempLow"]));
        return array_merge($vent, $temp);
    }
}

