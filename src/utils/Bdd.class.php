<?php
/*  Classe qui gère la connexion à la base de données
 *  À ne pas utiliser directement (faut passer par un manager)
 */
 
class Bdd extends PDO
{
    private $DB_OPTIONS = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, );
    
    
    public function __construct($host, $name, $user, $pass) {
        try {
            parent::__construct('pgsql:host='.$host.';dbname='.$name, $user, $pass, $this->DB_OPTIONS);
        }
        catch (PDOException $e) { Bdd::meurt('__construct',$e); }
    }
    
    public function execute($statement, $parameters)
    {
        try { 
            return $statement->execute($parameters); 
        }
        catch (PDOException $e) { Bdd::meurt('execute',$e); }
    }
    
    public function exec($statement)
    {
        try { 
            return parent::exec($statement); 
        }
        catch (PDOException $e) { Bdd::meurt('exec',$e); }
    }
    
    public function query($statement)
    {
        try { 
            return parent::query($statement); 
            }
        catch (PDOException $e) { Bdd::meurt('query',$e); }
    }
    
    private static function meurt($type, PDOException $e)
    {
        die('SQL Error : '.$e.' '.$type);
    }
}
?>
