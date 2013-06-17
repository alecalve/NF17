<?php

include_once(dirname(__FILE__).'/utils/BaseManager.class.php');

/*  Cette classe gère les villes et massifs.
 *  Elle doit être instanciée afin d'effectuer des requêtes sur la BDD * 
 */
class LieuManager extends BaseManager 
{
    /*  Crée une ville  
     */
    public function createVille($name, $couverture, $departement) {
        $this->db->beginTransaction();
        self::insertRequest("INSERT INTO tLieu (nom, couverture) VALUES (?, ?)", array($name, $couverture), "Échec de l'insertion dans la table lieu");
        self::insertRequest("INSERT INTO tVille (fkLieu, fkDepartement) VALUES (?, ?)", array($name, $departement), "Échec de l'insertion dans la table ville");
        if (!$this->db->commit()) {
            throw Exception("Impossible de commit la création du lieu");
        }
    }
    
    /*  Couvre une ville 
     */
    
    public function coverLieu($name) {
        self::updateRequest("UPDATE tLieu SET couverture = 'true' WHERE nom = ?;", array($name), "Échec de l'update de la couverture");
    }
    
    /*  Crée un massif
     *  Lève une exception si on veut lier le massif à plus de deux départements
     */
    public function createMassif($name, $couverture, $departements) {
        if (count($departements) > 2) {
            throw new Exception("Pas plus de deux départements pour un massif");
        }
        $this->db->beginTransaction();
        self::insertRequest("INSERT INTO tLieu (nom, couverture) VALUES (?, ?)", array($name, $couverture), "Échec de l'insertion dans la table lieu");
        self::insertRequest("INSERT INTO tMassif (fkLieu) VALUES (?)", array($name), "Échec de l'insertion dans la table massif");
        foreach($departements as $departement) {
            self::insertRequest("INSERT INTO tjMassifDepartement (massif, departement) VALUES (?, ?)", array($name, $departement), "Échec de l'insertion dans la table tjmassifdepartement");
        }
        if (!$this->db->commit()) {
            throw Exception("Impossible de commit la création du massif");
        }
    }
    
    /* Retourne true si le lieu est une ville, false sinon */
    private function isCity($lieu) {
        $array = self::getRequest("SELECT * FROM tVille WHERE fklieu = ?", array($lieu), 'Impossibilité de sélectionner le lieu.');
        if (empty($array)) {
            return false;
        } else {
            return true;
        }
    }
    
    /*  Retourne les informations d'un lieu (nom, couverture et départment(s)) 
     */
    public function getOne($name) {
        $query = "SELECT L.nom, L.couverture, V.fkDepartement FROM tLieu L, tVille V
                  WHERE L.nom=V.fkLieu AND L.nom=?
                  UNION
                  SELECT L.nom, L.couverture, TJ.departement FROM tLieu L, tjMassifDepartement TJ
                  WHERE L.nom=TJ.massif AND L.nom=?;";
        $array = self::getRequest($query, array($name, $name), 'Impossibilité de sélectionner le lieu.');
        //Pour les massifs, on peut avoir deux lignes de retour
        if (sizeof($array) == 2) {
            $return["nom"] = $array[0]["nom"];
            $return["couverture"] = $array[0]["couverture"];
            $return["fkDepartement"] = array($array[0]["fkdepartement"], $array[1]["fkdepartement"]);
        } else {
            $return["nom"] = $array[0]["nom"];
            $return["couverture"] = $array[0]["couverture"];
            $return["fkDepartement"] = array($array[0]["fkdepartement"]);
        }
        return $return;
    }
    
    /*  Retourne la liste (que les noms et leur couverture) des lieux sans préciser leur type (massif ou ville)     * 
     */
    public function getAll() {
        return self::getRequest("SELECT * FROM tLieu", array(), 'Impossibilité de sélectionner les lieux.');
    }
    
    public function getCovered() {
        return self::getRequest("SELECT * FROM tLieu WHERE couverture = ?", array("TRUE"), 'Impossibilité de sélectionner les lieux couverts.');
    }

    /* Supprime un lieu */
    public function delete($lieu) {
        self::getRequest("DELETE FROM tLieu WHERE nom = ?", array($lieu), 'Impossibilité de supprimer le lieu.');
    }
}
