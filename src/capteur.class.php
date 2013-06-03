<?php
include_once(dirname(__FILE__).'/utils/BaseManager.class.php');
include_once(dirname(__FILE__).'/lieu.class.php');

/*  Cette classe gère les capteurs
 *  On peut les insérer, affecter, etc.. en l'utilisant
 */
class CapteurManager extends BaseManager
{
    /*  Crée un capteur
     * 
     */
    public function create($id, $type) {
        self::insertRequest("INSERT INTO tCapteur (id, typeCapteur) VALUES (?, ?)", array($id, $type), "Échec lors de la création du capteur");
    }
    
    public function affect($lieu, $id, $dateDebut, $dateFin) {
        $LManager = new LieuManager();
        $LManager->coverLieu($lieu);
        self::insertRequest("INSERT INTO tAffectation (nom, id, dateDebut, dateFin) VALUES (?, ?, ?, ?)", 
                            array($lieu, $id, $dateDebut, $dateFin), 
                            "Échec lors de l'affectation du capteur");
    }
    
    /* Désaffecte un capteur d’une ville et l’affecte à une autre */
    public function displace($id, $lieu, $dateDebut, $dateFin) {
        self::updateRequest("UPDATE tAffectation SET dateFin = current_date -integer '1' WHERE dateFin > current_date AND id = ?",
                            array($id),
                            "Échec dans le déplacement du capteur");
        self::affect($lieu, $id, $dateDebut, $dateFin);        
    }
    
    /* Retourne la liste des capteurs (id et type) ainsi que leur affectation actuelle (nom)
     * Si ils ne sont pas affectés, le champ nom (nom du lieu), est NULL
     */
    public function getAll() {
        $query = "SELECT C.id, C.typeCapteur, A.nom FROM tCapteur C, tAffectation A WHERE C.id=A.id AND dateFin >= current_date
                UNION
                SELECT C.id, C.typeCapteur, NULL FROM tCapteur C WHERE C.id NOT IN 
                (SELECT C.id FROM tCapteur C, tAffectation A WHERE C.id=A.id AND dateFin >= current_date);";
        return self::getRequest($query, array(), "Impossible de trouver la liste des capteurs");     
    }
    
    public function getByLocation($lieu) {
        $query = "SELECT C.id, C.typeCapteur FROM tCapteur C, tAffectation A WHERE C.id=A.id AND dateFin >= current_date
                  AND A.nom = ?";
        return self::getRequest($query, array($lieu), "Impossible de trouver la liste des capteurs pour ce lieu");   
        
    }
    
    public function getHistorique($id) {
        $query = "SELECT A.nom, A.datedebut, A.datefin FROM tAffectation A WHERE A.id = ? ORDER BY A.datedebut";
        return self::getRequest($query, array($id), "Impossible de trouver l’historique");
    }
    
    public function getLocation($id) {
        $query = "SELECT nom FROM tAffectation WHERE id = ?";
        return self::getRequest($query, array($id), "Impossible de trouver le capteur")[0]["nom"];
    }
    
    /*  Renvoie la liste des capteurs inactifs (affectés nulle part)
     */
    public function getUnaffected() {
        $all =  self::getAll();
        $return = array();
        foreach($all as $capteur) {
            if ($capteur["nom"] == NULL) {
                $return[] = $capteur;
            }
        }
        return $return;
    } 
    
    /*  Renvoie la liste des capteurs actifs (affectés)
     */
    public function getAffected() {
        $all =  self::getAll();
        $return = array();
        foreach($all as $capteur) {
            if ($capteur["nom"] != NULL) {
                $return[] = $capteur;
            }
        }
        return $return;
    }
    
    public function getType($id) {
        $capteur = self::getRequest("SELECT typeCapteur FROM tCapteur WHERE id = ?",
                       array($id), "Impossible de retrouver le capteur");
        return $capteur[0]["typecapteur"];
    }
    
    /* Retourne la liste des différents types de capteurs
     */
    public function getTypeCapteurs() {
        $query = "SELECT
                e.enumlabel AS value
                FROM pg_type t 
                JOIN pg_enum e ON t.oid = e.enumtypid  
                JOIN pg_catalog.pg_namespace n ON n.oid = t.typnamespace
                WHERE
                t.typname = ?";
        return self::getRequest($query, array("typeprevision"), "Impossible de trouver la liste des types de capteurs");   
        
    }
}

