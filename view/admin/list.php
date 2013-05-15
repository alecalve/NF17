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
} else if ($_GET["list"] == "bulletin") {
    echo "<h3>Liste des bulletins</h3>";
} else if ($_GET["list"] == "capteur") {
    echo "<h3>Liste des capteurs</h3>";
    $capteurManager = new CapteurManager();
    $capteurs = $capteurManager->getAll();
    echo "<table class='table table-bordered table-stripped'>";
    echo "<tr><th>ID</th><th>Type</th></tr>";
    foreach($capteurs as $capteur) {
        echo sprintf("<tr><td>%s</td><td>%s</td></tr>", $capteur["id"], $capteur["typecapteur"]);
    }
    echo "</table>";
} else {

}

include_once(dirname(__DIR__).'/tail.php');
?>
