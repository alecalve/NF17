<?php
include_once(dirname((dirname(__DIR__))).'/src/capteur.class.php');
$capteurManager = new CapteurManager();
$historique = $capteurManager->getHistorique($_GET["id"]);
?>
<table class="table">
    <tr><th>Lieu</th><th>Date de début</th><th>Date de fin</th></tr>
    <?php
    foreach($historique as $line) {
        echo sprintf("<tr><td><a href='index.php?lieu=%s'>%s</a></td><td>%s</td><td>%s</td></tr>", $line["nom"], $line["nom"], $line["datedebut"], $line["datefin"]);
    }
    ?>
</table>
