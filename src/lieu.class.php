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
        parent::insertRequest("INSERT INTO tLieu (nom, couverture) VALUES (?, ?)", array($name, $couverture), "Échec de l'insertion dans la table lieu");
        parent::insertRequest("INSERT INTO tVille (fkLieu, fkDepartement) VALUES (?, ?)", array($name, $departement), "Échec de l'insertion dans la table ville");
    }
    
    /*  Crée un massif
     *  Lève une exception si on veut lier le massif à plus de deux départements
     */
    public function createMassif($name, $couverture, $departements) {
        if (sizeof($departements) > 2) {
            throw Exception("Un massif s'étend sur deux départements au maximum");
        }
        parent::insertRequest("INSERT INTO tLieu (nom, couverture) VALUES (?, ?)", array($name, $couverture), "Échec de l'insertion dans la table lieu");
        parent::insertRequest("INSERT INTO tMassif (fkLieu) VALUES (?)", array($name), "Échec de l'insertion dans la table massif");
        foreach($departements as $departement) {
            parent::insertRequest("INSERT INTO tjMassifDepartement (massif, departement) VALUES (?, ?)", array($name, $departement), "Échec de l'insertion dans la table tjmassifdepartement");
        }
    }
    
    /*  Retourne les informations d'un lieu (nom et couverture)     * 
     */
    public function getOne($name) {
        $array = parent::getRequest("SELECT * FROM tLieu L WHERE L.nom=?", array($name), 'Impossibilité de sélectionner le lieu.');
        if (empty($array)) {
            $array[0] = ""; //Petit trick afin d'éviter des PHP Notice: undefined offset 0
        }
        return $array[0];
    }
    
    /*  Retourne la liste (que les noms et leur couverture) des lieux sans préciser leur type (massif ou ville)     * 
     */
    public function getAll() {
        return parent::getRequest("SELECT * FROM tLieu", array(), 'Impossibilité de sélectionner les lieux.');
    }
}
