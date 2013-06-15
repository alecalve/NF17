<?php
include_once(dirname(__FILE__).'/utils/BaseManager.class.php');

class StatsManager extends BaseManager
{

    public function getMeanTempLieu($lieu, $start, $end) {
        //TODO : chercher syntaxe BETWEEN
        $query = "SELECT AVG(temp) FROM tPrevision 
                  WHERE typeprevision = 'température' 
                  AND dateprevision >= ? 
                  AND dateprevision <= ? 
                  AND nom = ?";
        return self::getRequest($query, array($start, $end, $lieu), "Erreur dans l’obtention de la moyenne des températures");
    }
    
    public function getMeanWindLieu($lieu, $start, $end) {
        $query = "SELECT AVG(force) 
                    FROM tPrevision 
                    WHERE typeprevision = 'vent' 
                    AND dateprevision >= ? 
                    AND dateprevision <= ? 
                    AND nom = ?";
        return self::getRequest($query, array($start, $end, $lieu), "Erreur dans l’obtention de la moyenne des vents");
    }
    
     public function getMeanTempDep($dep, $start, $end) {
        //TODO : chercher syntaxe BETWEEN
        $query = "SELECT AVG(temp) 
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  WHERE typeprevision = 'température' 
                  AND dateprevision >= ? 
                  AND dateprevision <= ? 
                  AND tjMassifDepartement.departement =?
                  UNION
                  SELECT AVG(temp) 
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  WHERE typeprevision = 'température' 
                  AND dateprevision >= ? 
                  AND dateprevision <= ? 
                  AND tVille.fkDepartement  = ?";
        return self::getRequest($query, array($start, $end, $dep,$start, $end, $dep), "Erreur dans l’obtention de la moyenne des températures");
    }
    
    public function getMeanWindDep($dep, $start, $end) {
        $query = "SELECT AVG(force) 
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  WHERE typeprevision = 'vent' 
                  AND dateprevision >= ? 
                  AND dateprevision <= ? 
                  AND tjMassifDepartement.departement =?
                  UNION
                  SELECT AVG(force) 
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  WHERE typeprevision = 'vent' 
                  AND dateprevision >= ? 
                  AND dateprevision <= ? 
                  AND tVille.fkDepartement  = ?";
        return self::getRequest($query, array($start, $end, $dep,$start, $end, $dep), "Erreur dans l’obtention de la moyenne des vents");
    }
    
    public function getMeanTempRegion($region, $start, $end) {
        //TODO : chercher syntaxe BETWEEN
        $query = "SELECT AVG(temp) 
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tjMassifDepartement.departement
                  WHERE typeprevision = 'température' 
                  AND dateprevision >= ? 
                  AND dateprevision <= ? 
                  AND tDepartement.fkRegion = ?
                  UNION
                  SELECT AVG(temp) 
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tVille.fkDepartement
                  WHERE typeprevision = 'température' 
                  AND dateprevision >= ? 
                  AND dateprevision <= ? 
                  AND tDepartement.fkRegion = ?";
        return self::getRequest($query, array($start, $end, $region, $start, $end, $region), "Erreur dans l’obtention de la moyenne des températures");
    }
    
    public function getMeanWindRegion($region, $start, $end) {
        $query = "SELECT AVG(force) 
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tjMassifDepartement.departement
                  WHERE typeprevision = 'vent' 
                  AND dateprevision >= ? 
                  AND dateprevision <= ? 
                  AND tDepartement.fkRegion = ?
                  UNION
                  SELECT AVG(force) 
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tVille.fkDepartement
                  WHERE typeprevision = 'vent' 
                  AND dateprevision >= ? 
                  AND dateprevision <= ? 
                  AND tDepartement.fkRegion = ?";
        return self::getRequest($query, array($start, $end, $region, $start, $end, $region), "Erreur dans l’obtention de la moyenne des températures");
    }
    
    public function getMaxWindLieu($start, $end) {
        $query = "SELECT nom, AVG(force) AS f FROM tPrevision 
                  WHERE typeprevision = 'vent' AND dateprevision >= ? AND dateprevision <= ?
                  GROUP BY nom
                  ORDER BY f DESC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end), "Erreur dans l’obtention du lieux le plus venteux");
    }
    
    public function getMaxTempLieu($temp = NULL, $start, $end) {
        $query = "SELECT nom, AVG(temp) AS f FROM tPrevision 
                  WHERE typeprevision = 'température' AND dateprevision >= ? AND dateprevision <= ?
                  GROUP BY nom
                  ORDER BY f DESC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end), "Erreur dans l’obtention du lieux le plus chaud");
    }
    
    public function getMaxTempLieu($temp = NULL, $start, $end) {
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
    
    public function getMeanTempLow($temp = NULL, $start, $end) {
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

