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
        $query = "SELECT AVG(temp) 
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  WHERE typeprevision = 'température' 
                  AND dateprevision BETWEEN ? AND ?
                  AND tjMassifDepartement.departement =?
                  UNION
                  SELECT AVG(temp) 
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  WHERE typeprevision = 'température' 
                  AND dateprevision BETWEEN ? AND ?
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
                    AND dateprevision BETWEEN ? AND ?
                    AND nom = ?";
        return self::getRequest($query, array($start, $end, $lieu), "Erreur dans l’obtention de la moyenne des vents");
    }
    
    public function getMeanWindDep($dep, $start, $end) {
        $query = "SELECT AVG(force) 
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  WHERE typeprevision = 'vent' 
                  AND dateprevision BETWEEN ? AND ?
                  AND tjMassifDepartement.departement =?
                  UNION
                  SELECT AVG(force) 
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  WHERE typeprevision = 'vent' 
                  AND dateprevision BETWEEN ? AND ?
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
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ?
                  AND tjMassifDepartement.departement =?
                  GROUP BY typePrecipitation
                  UNION
                  SELECT typePrecipitation, SUM(hauteur) 
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ?
                  AND tVille.fkDepartement  = ?
                  GROUP BY typePrecipitation";
        return self::getRequest($query, array($start, $end, $dep,$start, $end, $dep), "Erreur dans l’obtention de la moyenne des précipitationss");
    }
    
    public function getCumuPreciRegion($region, $start, $end) {
        $query = "SELECT typePrecipitation, SUM(hauteur) 
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tjMassifDepartement.departement
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ? 
                  AND tDepartement.fkRegion = ?
                  GROUP BY typePrecipitation
                  UNION
                  SELECT typePrecipitation, SUM(hauteur) 
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tVille.fkDepartement
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ? 
                  AND tDepartement.fkRegion = ?
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
        $query = "SELECT departement AS lieu , typePrecipitation AS type, SUM(hauteur) AS val
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ?
                  GROUP BY typePrecipitation, lieu
                  UNION
                  SELECT fkdepartement AS lieu , typePrecipitation AS type, SUM(hauteur) AS val
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ?
                  GROUP BY typePrecipitation, lieu
                  ORDER BY val DESC
                  LIMIT 1;";
        return self::getRequest($query, array($start, $end, $start, $end), "Erreur dans l’obtention de la moyenne des précipitationss");
    }
    
    public function getMaxCumuPreciReg($start, $end) {
        $query = "SELECT fkregion AS lieu , typePrecipitation AS type, SUM(hauteur) AS val
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tjMassifDepartement.departement
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ?
                  GROUP BY typePrecipitation, lieu
                  UNION
                  SELECT fkregion AS lieu , typePrecipitation AS type, SUM(hauteur) AS val
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tVille.fkDepartement
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
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ?
                  AND tjMassifDepartement.departement =?
                  GROUP BY typePrecipitation
                  UNION
                  SELECT typePrecipitation, AVG(hauteur) 
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ?
                  AND tVille.fkDepartement  = ?
                  GROUP BY typePrecipitation";
        return self::getRequest($query, array($start, $end, $dep,$start, $end, $dep), "Erreur dans l’obtention de la moyenne des précipitationss");
    }
    
    public function getMeanPreciRegion($region, $start, $end) {
        $query = "SELECT typePrecipitation, AVG(hauteur) 
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tjMassifDepartement.departement
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ? 
                  AND tDepartement.fkRegion = ?
                  GROUP BY typePrecipitation
                  UNION
                  SELECT typePrecipitation, AVG(hauteur) 
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tVille.fkDepartement
                  WHERE typeprevision = 'précipitations' 
                  AND dateprevision BETWEEN ? AND ? 
                  AND tDepartement.fkRegion = ?
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
        $query = "SELECT tjMassifDepartement.departement AS lieu, AVG(hauteur) AS avg, typePrecipitation AS type 
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  WHERE typeprevision = 'précipitations'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY tjMassifDepartement.departement, typePrecipitation
                  UNION
                  SELECT tVille.fkDepartement AS lieu, AVG(hauteur) AS avg, typePrecipitation AS type 
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  WHERE typeprevision = 'précipitations'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY tVille.fkDepartement, typePrecipitation
                  ORDER BY avg DESC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end, $start, $end), "Erreur dans l’obtention du département le plus précipitationseux");
    }
    
    public function getMaxPreciReg($start, $end) {
        $query = "SELECT tDepartement.fkRegion AS lieu, AVG(hauteur) AS avg, typePrecipitation AS type 
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tjMassifDepartement.departement
                  WHERE typeprevision = 'précipitations'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY tDepartement.fkRegion, typePrecipitation
                  UNION
                  SELECT tDepartement.fkRegion AS lieu, AVG(hauteur) AS avg, typePrecipitation AS type 
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tVille.fkDepartement
                  WHERE typeprevision = 'précipitations'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY tDepartement.fkRegion, typePrecipitation
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
        $query = "SELECT tjMassifDepartement.departement AS lieu, AVG(force) AS avg
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  WHERE typeprevision = 'vent'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY tjMassifDepartement.departement
                  UNION
                  SELECT tVille.fkDepartement AS lieu, AVG(force) AS avg
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  WHERE typeprevision = 'vent'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY tVille.fkDepartement
                  ORDER BY avg DESC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end, $start, $end), "Erreur dans l’obtention du département le plus venteux");
    }
    
    public function getMaxWindReg($start, $end) {
        $query = "SELECT tDepartement.fkRegion AS lieu, AVG(force) AS avg
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tjMassifDepartement.departement
                  WHERE typeprevision = 'vent'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY tDepartement.fkRegion
                  UNION
                  SELECT tDepartement.fkRegion AS lieu, AVG(force) AS avg
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tVille.fkDepartement
                  WHERE typeprevision = 'vent'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY tDepartement.fkRegion
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
        $query = "SELECT tjMassifDepartement.departement AS lieu, AVG(temp) AS avg
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY tjMassifDepartement.departement
                  UNION
                  SELECT tVille.fkDepartement AS lieu, AVG(temp) AS avg
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY tVille.fkDepartement
                  ORDER BY avg DESC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end, $start, $end), "Erreur dans l’obtention du département le plus chaud");
    }
    
    public function getMaxTempReg($start, $end) {
        $query = "SELECT tDepartement.fkRegion As lieu, AVG(temp) AS avg
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tjMassifDepartement.departement
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY tDepartement.fkRegion
                  UNION
                  SELECT tDepartement.fkRegion AS lieu, AVG(temp) AS avg
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tVille.fkDepartement
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY tDepartement.fkRegion
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
                  ORDER BY avg ASC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end), "Erreur dans l’obtention du lieux le plus froid");
    }
    
    public function getMinTempDep($start, $end) {
        $query = "SELECT tjMassifDepartement.departement AS lieu, AVG(temp) AS avg
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY tjMassifDepartement.departement
                  UNION
                  SELECT tVille.fkDepartement AS lieu, AVG(temp) AS t
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY tVille.fkDepartement
                  ORDER BY avg ASC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end, $start, $end), "Erreur dans l’obtention du département le plus venteux");
    }
    
    public function getMinTempReg($start, $end) {
        $query = "SELECT tDepartement.fkRegion AS lieu, AVG(temp) AS avg
                  FROM tPrevision 
                  INNER JOIN tjMassifDepartement ON tjMassifDepartement.massif = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tjMassifDepartement.departement
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY tDepartement.fkRegion
                  UNION
                  SELECT tDepartement.fkRegion AS lieu, AVG(temp) AS avg
                  FROM tPrevision
                  INNER JOIN tVille ON tVille.fkLieu = tPrevision.nom
                  INNER JOIN tDepartement ON tDepartement.nom = tVille.fkDepartement
                  WHERE typeprevision = 'température'
                  AND dateprevision BETWEEN ? AND ? 
                  GROUP BY tDepartement.fkRegion
                  ORDER BY avg ASC
                  LIMIT 1";
        return self::getRequest($query, array($start, $end, $start, $end), "Erreur dans l’obtention de la région la plus froide");
    }
}

