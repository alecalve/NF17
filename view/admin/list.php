<?php 
include_once(dirname(__DIR__).'/head.php');
include_once(dirname(__DIR__).'/head_admin.php');
include_once(dirname(dirname(__DIR__)).'/src/lieu.class.php');
include_once(dirname(dirname(__DIR__)).'/src/bulletin.class.php');
include_once(dirname(dirname(__DIR__)).'/src/capteur.class.php');
?>
            <div class="well">
<?php
if ($_GET["list"] == "lieu") {
    echo "<h3>Liste des lieux</h3>";
    $lieuxManager = new LieuManager();
    $lieux = $lieuxManager->getAll();
    echo "<table class='table table-bordered table-stripped'>";
    echo "<tr><th>Lieu</th><th>Couvert</th></tr>";
    foreach($lieux as $lieu) {
        if (!$lieu["couverture"]) {
            $couvertureString = "Non";
        } else {
            $couvertureString = "Oui";
        }
        echo sprintf("<tr><td><a href='index.php?lieu=%s'>%s</a></td><td>%s</td></tr>", $lieu["nom"], $lieu["nom"], $couvertureString);
    }
    
    echo "</table>";
} else if ($_GET["list"] == "bulletin") {
    echo "<h3>Liste des bulletins</h3>";
} else if ($_GET["list"] == "capteur") {
    echo "<h3>Liste des capteurs</h3>";
    $capteurManager = new CapteurManager();
    $capteurs = $capteurManager->getAll();
    echo "<table class='table table-bordered table-stripped'>";
    echo "<tr><th>ID</th><th>Type</th><th>Affectation actuelle</th></tr>";
    foreach($capteurs as $capteur) {
        if (!is_null($capteur["nom"])) {
            echo sprintf("<tr><td>%s</td><td>%s</td><td><a href='index.php?lieu=%s'>%s</a></td></tr>", $capteur["id"], $capteur["typecapteur"], $capteur["nom"], $capteur["nom"]);
        } else {
            echo sprintf("<tr><td>%s</td><td>%s</td><td>Pas affecté</td></tr>", $capteur["id"], $capteur["typecapteur"]);
        }
    }
    
    echo "</table>";
} else {

}
?>
    </div>
    </div>
<?
include_once(dirname(__DIR__).'/tail.php');
?>
