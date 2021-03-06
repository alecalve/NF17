<?php
include_once(dirname(__DIR__).'/src/alert.class.php');

$AManager = new AlertManager();

$alerts = $AManager->getAlerts();
if (!empty($alerts)) {
    echo "<div class='span12'>";
    foreach($alerts as $alert) {
        if ($alert["typeprevision"] == "vent") {
            echo sprintf("<div class='alert alert-error'><strong>Attention !</strong> Vent fort à %s le %s %s.</div>",
                         $alert["nom"], $alert["dateprevision"], $alert["periode"]);
        } else if ($alert["typeprevision"] == "température" && $alert["temp"] > 35) {
            echo sprintf("<div class='alert alert-error'><strong>Attention !</strong> Canicule à %s le %s %s.</div>",
                         $alert["nom"], $alert["dateprevision"], $alert["periode"]);
        } else if ($alert["typeprevision"] == "température" && $alert["temp"] < -5) {
            echo sprintf("<div class='alert alert-error'><strong>Attention !</strong> Grand froid à %s le %s %s.</div>",
                         $alert["nom"], $alert["dateprevision"], $alert["periode"]);
        } else if ($alert["typeprevision"] == "précipitations" && $alert["typeprecipitation"] == "pluie") {
            echo sprintf("<div class='alert alert-error'><strong>Attention !</strong> Fortes pluies à %s le %s %s.</div>",
                         $alert["nom"], $alert["dateprevision"], $alert["periode"]);
        } else if ($alert["typeprevision"] == "précipitations" && $alert["typeprecipitation"] == "grêle") {
            echo sprintf("<div class='alert alert-error'><strong>Attention !</strong> Averse de grêle à %s le %s %s.</div>",
                         $alert["nom"], $alert["dateprevision"], $alert["periode"]);
        } else if ($alert["typeprevision"] == "précipitations" && $alert["typeprecipitation"] == "météorites") {
            echo sprintf("<div class='alert alert-error'><strong>Attention !</strong> Pluie de météorites à %s le %s %s.</div>",
                         $alert["nom"], $alert["dateprevision"], $alert["periode"]);
        }
    }
    echo "</div>";
}
