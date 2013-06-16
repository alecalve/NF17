<?php
include_once(dirname(dirname(dirname(__DIR__))).'/src/capteur.class.php');

$CManager = new CapteurManager();
$type = $CManager->getTypeCapteur($_POST["capteur"]);

if ($type == "précipitations") {
    include_once("view/admin/forms/form_ajout_prev_preci.php");
} else if ($type == "vent") {
    include_once("view/admin/forms/form_ajout_prev_vent.php");
} else if ($type == "température") {
    include_once("view/admin/forms/form_ajout_prev_temp.php");
} else if ($type == "autre") {
    include_once("view/admin/forms/form_ajout_prev_autre.php");
}


