<?php
if (isset($_GET["id"])) {
    include_once("view/admin/historique_capteur_details.php");
} else {
    include_once("view/admin/historique_capteur_select.php");
}
