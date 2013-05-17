<?php

include_once(dirname(__FILE__).'/utils/BaseManager.class.php');

class LieuManager extends BaseManager 
{
    
    public function createVille($name, $couverture, $departement) {
        parent::insertRequest("INSERT INTO tLieu (nom, couverture) VALUES (?, ?)", array($name, $couverture), "Échec de l'insertion dans la table lieu");
        parent::insertRequest("INSERT INTO tVille (fkLieu, fkDepartement) VALUES (?, ?)", array($name, $departement), "Échec de l'insertion dans la table ville");
    }
    
    public function getOne($name) {
        $array = parent::getRequest("SELECT * FROM tLieu L WHERE L.nom=?", array($name), 'Impossibilité de sélectionner le lieu.');
        if (empty($array)) {
            $array[0] = ""; //Petit trick afin d'éviter des PHP Notice: undefined offset 0
        }
        return $array[0];
    }
    
    public function getAll() {
        return parent::getRequest("SELECT * FROM tLieu", array(), 'Impossibilité de sélectionner les lieux.');
    }
}
