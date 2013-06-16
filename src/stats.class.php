<?php
include_once(dirname(__FILE__).'/utils/BaseManager.class.php');

class StatsManager extends BaseManager
{
    
    /* Moyennes de températures */

    public function getMeanTempLieu($lieu, $start, $end) {
        $query = "SELECT AVG(temp) FROM tPrevision 
                  WHERE typeprevision = 'température' 
                  AND dateprevision >= ? 
                  AND dateprevision <= ? 
                  AND nom = ?";
        return self::getRequest($query, array($start, $end, $lieu), "Erreur dans l’obtention de la moyenne des températures du lieu");
    }
    
    public function getMeanTempDep($dep, $start, $end) {
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
        return self::getRequest($query, array($start, $end, $dep,$start, $end, $dep), "Erreur dans l’obtention de la moyenne des températures du département");
    }
    
    public function getMeanTempRegion($region, $start, $end) {
        $query = "SELECT AVG(temp) 
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tjMassifDepartement.departement
                  WHERE typeprevision = 'température' 
                  AND dateprevision BETWEEN ? AND ? 
                  AND tDepartement.fkRegion = ?
                  UNION
                  SELECT AVG(temp) 
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tVille.fkDepartement
                  WHERE typeprevision = 'température' 
                  AND dateprevision BETWEEN ? AND ? 
                  AND tDepartement.fkRegion = ?";
        return self::getRequest($query, array($start, $end, $region, $start, $end, $region), "Erreur dans l’obtention de la moyenne de la région");
    }
    
    /* Moyennes de vent */
    
    public function getMeanWindLieu($lieu, $start, $end) {
        $query = "SELECT AVG(force) 
                    FROM tPrevision 
                    WHERE typeprevision = 'vent' 
                    AND dateprevision >= ? 
                    AND dateprevision <= ? 
                    AND nom = ?";
        return self::getRequest($query, array($start, $end, $lieu), "Erreur dans l’obtention de la moyenne des vents");
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
    
    public function getMeanWindRegion($region, $start, $end) {
        $query = "SELECT AVG(force) 
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tjMassifDepartement.departement
                  WHERE typeprevision = 'vent' 
                  AND dateprevision BETWEEN ? AND ? 
                  AND tDepartement.fkRegion = ?
                  UNION
                  SELECT AVG(force) 
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tVille.fkDepartement
                  WHERE typeprevision = 'vent' 
                  AND dateprevision BETWEEN ? AND ? 
                  AND tDepartement.fkRegion = ?";
        return self::getRequest($query, array($start, $end, $region, $start, $end, $region), "Erreur dans l’obtention de la moyenne des v");
    }
    
    /* Maximums de vent */
    
    public function getMaxWindLieu($start, $end) {
        $query = "SELECT nom, AVG(force) AS f FROM tPrevision 
                  WHERE typeprevision = 'vent' AND dateprevision BETWEEN ? AND ? 
                  GROUP BY nom
                  ORDER BY f DESC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end), "Erreur dans l’obtention du lieux le plus venteux");
    }
    
    public function getMaxWindDep($start, $end) {
        $query = "SELECT tjMassifDepartement.departement, AVG(force) AS f
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  WHERE typeprevision = 'vent'
                  GROUP BY tjMassifDepartement.departement
                  UNION
                  SELECT tVille.fkDepartement, AVG(force) AS f
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  WHERE typeprevision = 'vent'
                  GROUP BY tVille.fkDepartement
                  ORDER BY f DESC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end), "Erreur dans l’obtention du département le plus venteux");
    }
    
    public function getMaxWindReg($start, $end) {
        $query = "SELECT tDepartement.fkRegion, AVG(force) AS f
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tjMassifDepartement.departement
                  WHERE typeprevision = 'vent'
                  GROUP BY tDepartement.fkRegion
                  UNION
                  SELECT tDepartement.fkRegion, AVG(force) AS f
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tVille.fkDepartement
                  WHERE typeprevision = 'vent'
                  GROUP BY tDepartement.fkRegion
                  ORDER BY f DESC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end), "Erreur dans l’obtention de la région la plus venteuse");
    }
    
    /* Maximums de temp */
    
    public function getMaxTempLieu($temp = NULL, $start, $end) {
        $query = "SELECT nom, AVG(temp) AS f FROM tPrevision 
                  WHERE typeprevision = 'température' AND dateprevision BETWEEN ? AND ? 
                  GROUP BY nom
                  ORDER BY f DESC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end), "Erreur dans l’obtention du lieux le plus chaud");
    }
    
    public function getMaxTempDep($start, $end) {
        $query = "SELECT tjMassifDepartement.departement, AVG(temp) AS t
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  WHERE typeprevision = 'température'
                  GROUP BY tjMassifDepartement.departement
                  UNION
                  SELECT tVille.fkDepartement, AVG(force) AS t
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  WHERE typeprevision = 'vent'
                  GROUP BY tVille.fkDepartement
                  ORDER BY t DESC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end), "Erreur dans l’obtention du département le plus chaud");
    }
    
    public function getMaxTempReg($start, $end) {
        $query = "SELECT tDepartement.fkRegion, AVG(temp) AS t
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tjMassifDepartement.departement
                  WHERE typeprevision = 'température'
                  GROUP BY tDepartement.fkRegion
                  UNION
                  SELECT tDepartement.fkRegion, AVG(temp) AS t
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tVille.fkDepartement
                  WHERE typeprevision = 'température'
                  GROUP BY tDepartement.fkRegion
                  ORDER BY t DESC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end), "Erreur dans l’obtention de la région la plus chaude");
    }
    
    /* Minimums de temp */
    
    public function getMinTempLieu($start, $end) {
        $query = "SELECT nom, AVG(temp) AS f FROM tPrevision 
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ?  
                  GROUP BY nom
                  ORDER BY f ASC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end), "Erreur dans l’obtention du lieux le plus froid");
    }
    
    public function getMinTempDep($start, $end) {
        $query = "SELECT tjMassifDepartement.departement, AVG(temp) AS t
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY tjMassifDepartement.departement
                  UNION
                  SELECT tVille.fkDepartement, AVG(force) AS t
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  WHERE typeprevision = 'vent'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY tVille.fkDepartement
                  ORDER BY t ASC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end), "Erreur dans l’obtention du département le plus venteux");
    }
    
    public function getMinTempReg($reg, $start, $end) {
        $query = "SELECT tDepartement.fkRegion, AVG(temp) AS t
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tjMassifDepartement.departement
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY tDepartement.fkRegion
                  UNION
                  SELECT tDepartement.fkRegion, AVG(temp) AS t
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tVille.fkDepartement
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY tDepartement.fkRegion
                  ORDER BY t ASC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end), "Erreur dans l’obtention de la région la plus froide");
    }
}

