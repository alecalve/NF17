<?php 

include_once(dirname((dirname(__DIR__))).'/src/lieu.class.php');
include_once(dirname((dirname(__DIR__))).'/src/bulletin.class.php');
include_once(dirname((dirname(__DIR__))).'/src/capteur.class.php');
include_once(dirname((dirname(__DIR__))).'/src/prevision.class.php');

/*  Cette page est chargée pour traiter le retour d'un formulaire
 *  En fonction du type du formulaire, on appelle les méthodes correspondantes des classes SQL
 *  Une fois que le traitement est effectué, on renvoie sur la page ou l'utilisateur peut voir le résultat de son action
 */
 
function erreur($args) {
    echo sprintf("<div class='alert alert-error'><strong>Attention !</strong> %s</div>", $args);    
}

if ($_POST["type"] == "ville") {
    $lieuManager = new lieuManager();
    $lieuManager->createVille($_POST["nom"], "FALSE", $_POST["departement"]);
    header('Location: index.php');
} else if ($_POST["type"] == "massif") {
    $lieuManager = new lieuManager();
    try {
        $lieuManager->createMassif($_POST["nom"], "FALSE", $_POST["departements"]);
        header('Location: index.php');
    } catch (Exception $e) {
        erreur($e->getMessage());
    }
} else if ($_POST["type"] == "capteurInsert") {
    if ((isset($_POST["id"])) && (isset($_POST["genre"]))) {
        $capteurManager = new CapteurManager();
        $capteurManager->create($_POST["id"], $_POST["genre"]);
        header('Location: admin.php?list=capteur');
    }
} else if ($_POST["type"] == "capteurAffect") {
    if ((isset($_POST["id"])) && (isset($_POST["lieu"])) && (isset($_POST["debut"])) && (isset($_POST["fin"]))) {
        $capteurManager = new CapteurManager();
        try {
            $capteurManager->affect($_POST["lieu"], $_POST["id"], $_POST["debut"], $_POST["fin"]);
            header('Location: admin.php?capteur=historique');
        } catch (Exception $e) {
            erreur($e->getMessage());
        }
        
    }
} else if ($_POST["type"] == "previsionAjout1") {
    $CManager = new CapteurManager();
    $PManager = new PrevisionManager();
    
    $lieu = $CManager->getLocation($_POST["capteur"]);
    $type = $CManager->getTypeCapteur($_POST["capteur"]);
    
    if ($PManager->canInsert($_POST["date"], $_POST["periode"], $lieu, $type)) {
        include_once("view/admin/forms/form_ajout_prevision2.php");
    } else {
        erreur($e->getMessage());
    }
    
} else if ($_POST["type"] == "previsionAjout2") {
    
    $CManager = new CapteurManager();
    $PManager = new PrevisionManager();
    
    $lieu = $CManager->getLocation($_POST["capteur"]);
    $type = $CManager->getTypeCapteur($_POST["capteur"]);
    
    if ($type == "précipitations") {
        $PManager->createPluie($_POST["date"], $_POST["periode"], $lieu, $_POST["descr"], $_POST["typePreci"], $_POST["hauteur"], $type);
    } else if ($type == "vent") {
        $PManager->createVent( $_POST["date"], $_POST["periode"], $lieu, $_POST["descr"], $_POST["force"], $_POST["direction"], $type);
    } else if ($type == "température") {
        $PManager->createTemp($_POST["date"], $_POST["periode"], $lieu, $_POST["descr"], $_POST["temp"], $_POST["ressenti"], $type);
    } else if ($type == "autre") {
        $PManager->createAutre($_POST["date"], $_POST["periode"], $lieu, $_POST["descr"], $type);
    }
    
    header('Location: admin.php');
} else { 
    header('Location: admin.php');
}    
