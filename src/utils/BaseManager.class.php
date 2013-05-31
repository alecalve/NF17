<?php

include_once(dirname(__FILE__).'/Bdd.class.php');
include_once(dirname(dirname(__DIR__)).'/conf.php');

/*  Classe de base des classes managers d'objet
 *  Elle ne doit pas être instanciée directement, elle sert d'intermédiaire entre le PHP et le SQL
 */
class BaseManager
{
    //On garde en attribut privé la connection à la base de données
    private $db;

    /*  À sa construction, cette classe se connecte à la base de données
     */
    function __construct() {
        //On met $_CONF en global pour pouvoir y accèder à l'intérieur de la définition de la classe
        global $_CONF;
        $this->db = new Bdd($_CONF['db_host'], $_CONF['db_name'], $_CONF['db_user'], $_CONF['db_pass']);
    }
    
    /*  Exécute une requête de type SELECT et retourne le résultat sous forme de tableau associatif (clé -> valeur)
     *  Les clés sont les noms des champs SQL
     *  En cas d'échec, une exception est levée
     */
    protected function getRequest($request, $params, $exceptionMessage) {
        $request = $this->db->prepare($request);
        $success = $this->db->execute($request, $params);
        if (!$success) {
            throw new Exception($exceptionMessage);
        }
        $array = $request->fetchAll(PDO::FETCH_ASSOC);
        return $array;        
    }
    
    /*  Pareil que getRequest sauf que elle ne renvoie rien (pratique pour les INSERT)
     */
    protected function insertRequest($request, $params, $exceptionMessage) {
        $request = $this->db->prepare($request);
        $success = $this->db->execute($request, $params);
        if (!$success) {
            throw new Exception($exceptionMessage);
        }    
    }
    
    protected function updateRequest($request, $params, $exceptionMessage) {
        self::insertRequest($request, $params, $exceptionMessage);
    }
    
    
}

