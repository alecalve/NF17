<?php
include_once(dirname(__FILE__).'/utils/BaseManager.class.php');

class StatsManager extends BaseManager
{
    
    /* Moyennes de températures */

    public function getMeanTempLieu($lieu, $start, $end) {
        $query = "SELECT AVG(temp) FROM tPrevision 
                  WHERE typeprevision = 'température' 
                  AND dateprevision BETWEEN ? AND ?
                  AND nom = ?";
        return self::getRequest($query, array($start, $end, $lieu), "Erreur dans l’obtention de la moyenne des températures du lieu");
    }

    public function getMeanTempDep($dep, $start, $end) {
        $query = "SELECT AVG(temp) AS avg
                  FROM vPreviDepMassif
                  WHERE typeprevision = 'température' 
                  AND dateprevision BETWEEN ? AND ?
                  AND lieu =?
                  UNION
                  SELECT AVG(temp) 
                  FROM vPreviDepVille
                  WHERE typeprevision = 'température' 
                  AND dateprevision BETWEEN ? AND ?
                  AND lieu  = ?";
        return self::getRequest($query, array($start, $end, $dep, $start, $end, $dep), "Erreur dans l’obtention de la moyenne des températures du département");
    }
    
    public function getMeanTempRegion($region, $start, $end) {
        $query = "SELECT AVG(temp) 
                  FROM vPreviRegVille
                  WHERE typeprevision = 'température' 
                  AND dateprevision BETWEEN ? AND ? 
                  AND lieu = ?
                  UNION
                  SELECT AVG(temp) 
                  FROM vPreviRegMassif
                  WHERE typeprevision = 'température' 
                  AND dateprevision BETWEEN ? AND ? 
                  AND lieu = ?";
        return self::getRequest($query, array($start, $end, $region, $start, $end, $region), "Erreur dans l’obtention de la moyenne de la région");
    }
    
    /* Moyennes de vent */
    
    public function getMeanWindLieu($lieu, $start, $end) {
        $query = "SELECT AVG(force) 
                    FROM tPrevision 
                    WHERE typeprevision = 'vent' 
                    AND dateprevision BETWEEN ? AND ?
                    AND nom = ?";
        return self::getRequest($query, array($start, $end, $lieu), "Erreur dans l’obtention de la moyenne des vents");
    }
    
    public function getMeanWindDep($dep, $start, $end) {
        $query = "SELECT AVG(force) 
                  FROM vPreviDepMassif
                  WHERE typeprevision = 'vent' 
                  AND dateprevision BETWEEN ? AND ?
                  AND lieu =?
                  UNION
                  SELECT AVG(force) 
                  FROM vPreviDepVille
                  WHERE typeprevision = 'vent' 
                  AND dateprevision BETWEEN ? AND ?
                  AND lieu  = ?";
        return self::getRequest($query, array($start, $end, $dep,$start, $end, $dep), "Erreur dans l’obtention de la moyenne des vents");
    }
    
    public function getMeanWindRegion($region, $start, $end) {
        $query = "SELECT AVG(force) 
                  FROM vPreviRegVille
                  WHERE typeprevision = 'vent' 
                  AND dateprevision BETWEEN ? AND ? 
                  AND lieu = ?
                  UNION
                  SELECT AVG(force) 
                  FROM vPreviRegMassif
                  WHERE typeprevision = 'vent' 
                  AND dateprevision BETWEEN ? AND ? 
                  AND lieu = ?";
        return self::getRequest($query, array($start, $end, $region, $start, $end, $region), "Erreur dans l’obtention de la moyenne des v");
    }
    
    /* Cumulés de précipitations */
    
    public function getCumuPreciLieu($lieu, $start, $end) {
        $query = "SELECT typePrecipitation, SUM(hauteur) 
                  FROM tPrevision 
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ?
                  AND nom = ?
                  GROUP BY typePrecipitation";
        return self::getRequest($query, array($start, $end, $lieu), "Erreur dans l’obtention de la moyenne des précipitationss");
    }
    
    public function getCumuPreciDep($dep, $start, $end) {
        $query = "SELECT typePrecipitation, SUM(hauteur) 
                  FROM vPreviDepMassif
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ?
                  AND lieu =?
                  GROUP BY typePrecipitation
                  UNION
                  SELECT typePrecipitation, SUM(hauteur) 
                  FROM vPreviDepVille
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ?
                  AND lieu  = ?
                  GROUP BY typePrecipitation";
        return self::getRequest($query, array($start, $end, $dep,$start, $end, $dep), "Erreur dans l’obtention de la moyenne des précipitationss");
    }
    
    public function getCumuPreciRegion($region, $start, $end) {
        $query = "SELECT typePrecipitation, SUM(hauteur) 
                  FROM vPreviRegVille
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ? 
                  AND lieu = ?
                  GROUP BY typePrecipitation
                  UNION
                  SELECT typePrecipitation, SUM(hauteur) 
                  FROM vPreviRegMassif
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ? 
                  AND lieu = ?
                  GROUP BY typePrecipitation";
        return self::getRequest($query, array($start, $end, $region, $start, $end, $region), "Erreur dans l’obtention de la moyenne des v");
    }
    
    /* Cumulés maximums de précipitations */
    
    public function getMaxCumuPreciLieu($start, $end) {
        $query = "SELECT nom AS lieu , typePrecipitation AS type, SUM(hauteur) AS val
                  FROM tPrevision 
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ?
                  GROUP BY typePrecipitation, lieu
                  ORDER BY val DESC
                  LIMIT 1;";
        return self::getRequest($query, array($start, $end), "Erreur dans l’obtention de la moyenne des précipitationss");
    }
    
    public function getMaxCumuPreciDep($start, $end) {
        $query = "SELECT lieu , typePrecipitation AS type, SUM(hauteur) AS val
                  FROM vPreviDepMassif
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ?
                  GROUP BY typePrecipitation, lieu
                  UNION
                  SELECT lieu , typePrecipitation AS type, SUM(hauteur) AS val
                  FROM vPreviDepVille
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ?
                  GROUP BY typePrecipitation, lieu
                  ORDER BY val DESC
                  LIMIT 1;";
        return self::getRequest($query, array($start, $end, $start, $end), "Erreur dans l’obtention de la moyenne des précipitationss");
    }
    
    public function getMaxCumuPreciReg($start, $end) {
        $query = "SELECT lieu , typePrecipitation AS type, SUM(hauteur) AS val
                  FROM vPreviRegVille
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ?
                  GROUP BY typePrecipitation, lieu
                  UNION
                  SELECT lieu , typePrecipitation AS type, SUM(hauteur) AS val
                  FROM vPreviRegMassif
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ?
                  GROUP BY typePrecipitation, lieu
                  ORDER BY val DESC
                  LIMIT 1;";
        return self::getRequest($query, array($start, $end, $start, $end), "Erreur dans l’obtention de la moyenne des v");
    }
    
    /* Moyennes de précipitations */
    
    public function getMeanPreciLieu($lieu, $start, $end) {
        $query = "SELECT typePrecipitation, AVG(hauteur) 
                  FROM tPrevision 
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ?
                  AND nom = ?
                  GROUP BY typePrecipitation";
        return self::getRequest($query, array($start, $end, $lieu), "Erreur dans l’obtention de la moyenne des précipitationss");
    }
    
    public function getMeanPreciDep($dep, $start, $end) {
        $query = "SELECT typePrecipitation, AVG(hauteur) 
                  FROM vPreviDepMassif
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ?
                  AND lieu =?
                  GROUP BY typePrecipitation
                  UNION
                  SELECT typePrecipitation, AVG(hauteur) 
                  FROM vPreviDepVille
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ?
                  AND lieu  = ?
                  GROUP BY typePrecipitation";
        return self::getRequest($query, array($start, $end, $dep,$start, $end, $dep), "Erreur dans l’obtention de la moyenne des précipitationss");
    }
    
    public function getMeanPreciRegion($region, $start, $end) {
        $query = "SELECT typePrecipitation, AVG(hauteur) 
                  FROM vPreviRegVille
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ? 
                  AND lieu = ?
                  GROUP BY typePrecipitation
                  UNION
                  SELECT typePrecipitation, AVG(hauteur) 
                  FROM vPreviRegMassif
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ? 
                  AND lieu = ?
                  GROUP BY typePrecipitation";
        return self::getRequest($query, array($start, $end, $region, $start, $end, $region), "Erreur dans l’obtention de la moyenne des v");
    }
    
    /* Maximums de précipitations */
    
    public function getMaxPreciLieu($start, $end) {
        $query = "SELECT nom AS lieu, AVG(hauteur) AS avg, typePrecipitation AS type  FROM tPrevision 
                  WHERE typeprevision = 'précipitations'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY nom,typePrecipitation
                  ORDER BY avg DESC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end), "Erreur dans l’obtention du lieux le plus précipitationseux");
    }
    
    public function getMaxPreciDep($start, $end) {
        $query = "SELECT lieu, AVG(hauteur) AS avg, typePrecipitation AS type 
                  FROM vPreviDepMassif
                  WHERE typeprevision = 'précipitations'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY lieu, typePrecipitation
                  UNION
                  SELECT lieu, AVG(hauteur) AS avg, typePrecipitation AS type 
                  FROM vPreviDepVille
                  WHERE typeprevision = 'précipitations'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY lieu, typePrecipitation
                  ORDER BY avg DESC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end, $start, $end), "Erreur dans l’obtention du département le plus précipitationseux");
    }
    
    public function getMaxPreciReg($start, $end) {
        $query = "SELECT lieu, AVG(hauteur) AS avg, typePrecipitation AS type 
                  FROM vPreviRegVille
                  WHERE typeprevision = 'précipitations'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY lieu, typePrecipitation
                  UNION
                  SELECT lieu, AVG(hauteur) AS avg, typePrecipitation AS type 
                  FROM vPreviRegMassif
                  WHERE typeprevision = 'précipitations'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY lieu, typePrecipitation
                  ORDER BY avg DESC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end, $start, $end), "Erreur dans l’obtention de la région la plus précipitationseuse");
    }
    
    /* Maximums de vent */
    
    public function getMaxWindLieu($start, $end) {
        $query = "SELECT nom AS lieu, AVG(force) AS avg FROM tPrevision 
                  WHERE typeprevision = 'vent'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY nom
                  ORDER BY avg DESC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end), "Erreur dans l’obtention du lieux le plus venteux");
    }
    
    public function getMaxWindDep($start, $end) {
        $query = "SELECT lieu, AVG(force) AS avg
                  FROM vPreviDepMassif
                  WHERE typeprevision = 'vent'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY lieu
                  UNION
                  SELECT lieu, AVG(force) AS avg
                  FROM vPreviDepVille
                  WHERE typeprevision = 'vent'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY lieu
                  ORDER BY avg DESC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end, $start, $end), "Erreur dans l’obtention du département le plus venteux");
    }
    
    public function getMaxWindReg($start, $end) {
        $query = "SELECT lieu, AVG(force) AS avg
                  FROM vPreviRegVille
                  WHERE typeprevision = 'vent'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY lieu
                  UNION
                  SELECT lieu, AVG(force) AS avg
                  FROM vPreviRegMassif
                  WHERE typeprevision = 'vent'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY lieu
                  ORDER BY avg DESC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end, $start, $end), "Erreur dans l’obtention de la région la plus venteuse");
    }
    
    /* Maximums de temp */
    
    public function getMaxTempLieu($start, $end) {
        $query = "SELECT nom AS lieu, AVG(temp) AS avg FROM tPrevision 
                  WHERE typeprevision = 'température' AND dateprevision BETWEEN ? AND ? 
                  GROUP BY nom
                  ORDER BY avg DESC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end), "Erreur dans l’obtention du lieux le plus chaud");
    }
    
    public function getMaxTempDep($start, $end) {
        $query = "SELECT lieu, AVG(temp) AS avg
                  FROM vPreviDepMassif
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY lieu
                  UNION
                  SELECT lieu, AVG(temp) AS avg
                  FROM vPreviDepVille
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY lieu
                  ORDER BY avg DESC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end, $start, $end), "Erreur dans l’obtention du département le plus chaud");
    }
    
    public function getMaxTempReg($start, $end) {
        $query = "SELECT lieu, AVG(temp) AS avg
                  FROM vPreviRegVille
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY lieu
                  UNION
                  SELECT lieu, AVG(temp) AS avg
                  FROM vPreviRegMassif
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY lieu
                  ORDER BY avg DESC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end, $start, $end), "Erreur dans l’obtention de la région la plus chaude");
    }
    
    /* Minimums de temp */
    
    public function getMinTempLieu($start, $end) {
        $query = "SELECT nom AS lieu, AVG(temp) AS avg FROM tPrevision 
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ?  
                  GROUP BY nom
                  ORDER BY avg ASC";
        return self::getRequest($query, array($start, $end), "Erreur dans l’obtention du lieux le plus froid");
    }
    
    public function getMinTempDep($start, $end) {
        $query = "SELECT lieu, AVG(temp) AS avg
                  FROM vPreviDepMassif
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY lieu
                  UNION
                  SELECT lieu, AVG(temp) AS avg
                  FROM vPreviDepVille
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY lieu
                  ORDER BY avg ASC";
        return self::getRequest($query, array($start, $end, $start, $end), "Erreur dans l’obtention du département le plus venteux");
    }
    
    public function getMinTempReg($start, $end) {
        $query = "SELECT lieu, AVG(temp) AS avg
                  FROM vPreviRegVille
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY lieu
                  UNION
                  SELECT lieu, AVG(temp) AS avg
                  FROM vPreviRegMassif
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY lieu
                  ORDER BY avg ASC";
        return self::getRequest($query, array($start, $end, $start, $end), "Erreur dans l’obtention de la région la plus froide");
    }
    
    /* Lieux plus concernés par une certaine moyenne de température */

    public function getConcernedTempLieu($temp, $marge, $start, $end) {
        $temp = floatval($temp);
        $marge = floatval($marge);
        $query = "SELECT nom AS lieu, AVG(temp) AS avg FROM tPrevision 
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ?
                  GROUP BY nom
                  HAVING AVG(temp) BETWEEN ? AND ?";
        return self::getRequest($query, array($start, $end, $temp - $marge, $temp + $marge), "Erreur dans l’obtention du lieux le plus concerné");
    }
    
    public function getConcernedTempDep($temp, $marge, $start, $end) {
        $temp = floatval($temp);
        $marge = floatval($marge);
        $query = "SELECT lieu, AVG(temp) AS avg
                  FROM vPreviDepMassif
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY lieu
                  HAVING AVG(temp) BETWEEN ? AND ?
                  UNION
                  SELECT lieu, AVG(temp) AS avg
                  FROM vPreviDepVille
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY lieu
                  HAVING AVG(temp) BETWEEN ? AND ?";
        return self::getRequest($query, array($start, $end, $temp - $marge, $temp + $marge, $start, $end, $temp - $marge, $temp + $marge),
                                "Erreur dans l’obtention du département le plus concerné");
    }
    
    public function getConcernedTempReg($temp, $marge, $start, $end) {
        $temp = floatval($temp);
        $marge = floatval($marge);
        $query = "SELECT lieu, AVG(temp) AS avg
                  FROM vPreviRegVille
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ?
                  GROUP BY lieu
                  HAVING AVG(temp) BETWEEN ? AND ?
                  UNION
                  SELECT lieu, AVG(temp) AS avg
                  FROM vPreviRegMassif
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ?
                  GROUP BY lieu
                  HAVING AVG(temp) BETWEEN ? AND ?";
        return self::getRequest($query, array($start, $end, $temp - $marge, $temp + $marge, $start, $end, $temp - $marge, $temp + $marge),
                                "Erreur dans l’obtention de la région la plus concernée");
    }
    
     /* Lieux plus concernés par une certaine moyenne de vent */

    public function getConcernedWindLieu($force, $marge, $start, $end) {
        $force = floatval($force);
        $marge = floatval($marge);
        $query = "SELECT nom AS lieu, AVG(force) AS avg FROM tPrevision 
                  WHERE typeprevision = 'vent'
                  AND dateprevision BETWEEN ? AND ?
                  GROUP BY nom
                  HAVING AVG(force) BETWEEN ? AND ? ";
        return self::getRequest($query, array($start, $end, $force - $marge, $force + $marge), "Erreur dans l’obtention du lieux le plus concerné");
    }
    
    public function getConcernedWindDep($force, $marge, $start, $end) {
        $force = floatval($force);
        $marge = floatval($marge);
        $query = "SELECT lieu, AVG(force) AS avg
                  FROM vPreviDepVille
                  WHERE typeprevision = 'vent'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY lieu
                  HAVING AVG(force) BETWEEN ? AND ? 
                  UNION
                  SELECT lieu, AVG(force) AS avg
                  FROM vPreviDepMassif
                  WHERE typeprevision = 'vent'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY lieu
                  HAVING AVG(force) BETWEEN ? AND ? ";
        return self::getRequest($query, array($start, $end, $force - $marge, $force + $marge, $start, $end, $force - $marge, $force + $marge),
                                "Erreur dans l’obtention du département le plus concerné");
    }
    
    public function getConcernedWindReg($force, $marge, $start, $end) {
        $force = floatval($force);
        $marge = floatval($marge);
        $query = "SELECT lieu, AVG(force) AS avg
                  FROM vPreviRegMassif
                  WHERE typeprevision = 'vent'
                  AND dateprevision BETWEEN ? AND ?
                  GROUP BY lieu
                  HAVING AVG(force) BETWEEN ? AND ? 
                  UNION
                  SELECT lieu, AVG(force) AS avg
                  FROM vPreviRegVille
                  WHERE typeprevision = 'vent'
                  AND dateprevision BETWEEN ? AND ?
                  GROUP BY lieu
                  HAVING AVG(force) BETWEEN ? AND ? ";
        return self::getRequest($query, array($start, $end, $force - $marge, $force + $marge, $start, $end, $force - $marge, $force + $marge),
                                "Erreur dans l’obtention de la région la plus concernée");
    }
}

