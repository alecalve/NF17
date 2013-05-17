<?php

include_once(dirname(__FILE__).'/Bdd.class.php');
include_once(dirname(dirname(__DIR__)).'/conf.php');

class BaseManager
{
    
    private $db;

    function __construct() {
        global $_CONF;
        $this->db = new Bdd($_CONF['db_host'], $_CONF['db_name'], $_CONF['db_user'], $_CONF['db_pass']);
    }
    
    protected function getRequest($request, $params, $exceptionMessage) {
        $request = $this->db->prepare($request);
        $success = $this->db->execute($request, $params);
        if (!$success) {
            throw new Exception($exceptionMessage);
        }
        $array = $request->fetchAll(PDO::FETCH_ASSOC);
        return $array;        
    }
    
    protected function insertRequest($request, $params, $exceptionMessage) {
        $request = $this->db->prepare($request);
        $success = $this->db->execute($request, $params);
        if (!$success) {
            throw new Exception($exceptionMessage);
        }      
    }
}

