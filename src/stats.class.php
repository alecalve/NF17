<?php
include_once(dirname(__FILE__).'/utils/BaseManager.class.php');

class StatsManager extends BaseManager
{
    
    public function getMeanTemp($lieu, $start, $end) {
        //TODO : chercher syntaxe BETWEEN
        $query = "SELECT AVG(temp) FROM tPrevision WHERE typeprevision = 'température' AND dateprevision >= ? AND dateprevision <= ? AND nom = ?";
        return self::getRequest($query, array($start, $end, $lieu), "Erreur dans l’obtention de la moyenne des températures");
    }
    
    public function getMeanWind($lieu, $start, $end) {
        $query = "SELECT AVG(force) FROM tPrevision WHERE typeprevision = 'vent' AND dateprevision >= ? AND dateprevision <= ? AND nom = ?";
        return self::getRequest($query, array($start, $end, $lieu), "Erreur dans l’obtention de la moyenne des vents");
    }
    
    //Si force est NULL, renvoie le lieu avec la plus grande moyenne de vent
    public function getMostWind($force = NULL, $start, $end) {
        if ($force == NULL) {
            $query = "SELECT nom, AVG(force) AS f FROM tPrevision 
                      WHERE typeprevision = 'vent' AND dateprevision >= ? AND dateprevision <= ?
                      GROUP BY nom
                      ORDER BY f DESC
                      LIMIT 1";
            return self::getRequest($query, array($start, $end), "Erreur dans l’obtention du lieux le plus venteux");
        } else {
            $query = "SELECT nom, COUNT(force) AS f FROM tPrevision 
                      WHERE typeprevision = 'vent' AND dateprevision >= ? AND dateprevision <= ?
                      AND force = ?
                      GROUP BY nom
                      ORDER BY f DESC
                      LIMIT 1";
            return self::getRequest($query, array($start, $end, $force), "Erreur dans l’obtention du lieux le plus venteux");
        }
    }
    
    //Si temp est NULL, renvoie le lieu avec la plus grande moyenne de température
    public function getHighestTemp($temp = NULL, $start, $end) {
        if ($force == NULL) {
            $query = "SELECT nom, AVG(temp) AS f FROM tPrevision 
                      WHERE typeprevision = 'température' AND dateprevision >= ? AND dateprevision <= ?
                      GROUP BY nom
                      ORDER BY f DESC
                      LIMIT 1";
            return self::getRequest($query, array($start, $end), "Erreur dans l’obtention du lieux le plus venteux");
        } else {
            $query = "SELECT nom, COUNT(temp) AS f FROM tPrevision 
                      WHERE typeprevision = 'température' AND dateprevision >= ? AND dateprevision <= ?
                      AND temp = ?
                      GROUP BY nom
                      ORDER BY f DESC
                      LIMIT 1";
            return self::getRequest($query, array($start, $end, $force), "Erreur dans l’obtention du lieux le plus chaud");
        }
    }
    
    public function getLowestTemp($temp = NULL, $start, $end) {
        if ($force == NULL) {
            $query = "SELECT nom, AVG(temp) AS f FROM tPrevision 
                      WHERE typeprevision = 'température' AND dateprevision >= ? AND dateprevision <= ?
                      GROUP BY nom
                      ORDER BY f ASC
                      LIMIT 1";
            return self::getRequest($query, array($start, $end), "Erreur dans l’obtention du lieux le plus venteux");
        } else {
            $query = "SELECT nom, COUNT(temp) AS f FROM tPrevision 
                      WHERE typeprevision = 'température' AND dateprevision >= ? AND dateprevision <= ?
                      AND temp = ?
                      GROUP BY nom
                      ORDER BY f ASC
                      LIMIT 1";
            return self::getRequest($query, array($start, $end, $force), "Erreur dans l’obtention du lieux le plus chaud");
        }
    }
}

