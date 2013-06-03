<?php 

include_once(dirname((dirname(__DIR__))).'/src/lieu.class.php');
include_once(dirname((dirname(__DIR__))).'/src/bulletin.class.php');
include_once(dirname((dirname(__DIR__))).'/src/capteur.class.php');

/*  Cette page est chargée pour traiter le retour d'un formulaire
 *  En fonction du type du formulaire, on appelle les méthodes correspondantes des classes SQL
 *  Une fois que le traitement est effectué, on renvoie sur la page ou l'utilisateur peut voir le résultat de son action
 */

if ($_POST["type"] == "ville") {
    $lieuManager = new lieuManager();
    $lieuManager->createVille($_POST["nom"], "FALSE", $_POST["departement"]);
    header('Location: index.php');
} else if ($_POST["type"] == "massif") {
    $lieuManager = new lieuManager();
    $lieuManager->createMassif($_POST["nom"], "FALSE", $_POST["departement"]);
    header('Location: index.php');
} else if ($_POST["type"] == "capteurInsert") {
    if ((isset($_POST["id"])) && (isset($_POST["genre"]))) {
        $capteurManager = new CapteurManager();
        $capteurManager->create($_POST["id"], $_POST["genre"]);
        header('Location: admin.php?list=capteur');
    }
} else if ($_POST["type"] == "capteurAffect") {
    if ((isset($_POST["id"])) && (isset($_POST["lieu"])) && (isset($_POST["debut"])) && (isset($_POST["fin"]))) {
        $capteurManager = new CapteurManager();
        $capteurManager->affect($_POST["lieu"], $_POST["id"], $_POST["debut"], $_POST["fin"]);
        header('Location: admin.php?capteur=historique');
    }
} else if ($_POST["type"] == "previsionAjout1") {
    include_once("view/admin/forms/form_ajout_prevision2.php");
} else { 
    header('Location: admin.php');
}    
