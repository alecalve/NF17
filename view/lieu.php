<?php
include(dirname(__DIR__).'/src/lieu.class.php');
include(dirname(__DIR__).'/src/bulletin.class.php');
include(dirname(__DIR__).'/src/capteur.class.php');

$lieux = new LieuManager();
$bulletins = new BulletinManager();
$CManager = new CapteurManager();
$lieu = $lieux->getOne($_POST["lieu"]);
$date = explode(" ",$_POST["bulletin"])[0];
$periode = explode(" ",$_POST["bulletin"])[1];
$previs = $bulletins->getPrevisions($_POST["lieu"], $date, $periode);
$capteurs = $CManager->getByLocation($_POST["lieu"]);
$capteurString = "";
if (empty($capteurs)) {
    $capteurString = "Pas de capteurs affectés à ce lieu.";
} else {
    $carray = array();
    foreach($capteurs as $capteur) {
        $carray[] = $capteur["id"]." (".$capteur["typecapteur"].")";
    }
    $capteurString = join(", ", $carray);
}
if (sizeof($lieu["fkDepartement"]) == 2) {
    $departementString = $lieu["fkDepartement"][0].", ".$lieu["fkDepartement"][1];
} else {
    $departementString = $lieu["fkDepartement"][0];    
}

?>
        <div class="row">
            <div class="span12">
                <div class="page-header">
                    <h1><?php echo $_POST["lieu"]; ?><small><a href="index.php"> retour</a></small></h1>
                    <p>Département : <i><?php echo $departementString; ?></i></p>
                    <p>Capteur(s) : <i><?php echo $capteurString; ?></i></p>
                </div>
                <?php 
                foreach($previs as $prev) {
                    echo "<div class='span4'>";
                    echo "<p><b>Prévision</b> : ".$prev["typeprevision"]."</p>";
                    echo "<p><b>Description</b> :<br>".$prev["description"]."</p>";
                    if ($prev["typeprevision"] == "vent") {
                        echo "<p><b>Force du vent : </b>".$prev["force"]."</p>";
                        echo "<p><b>Direction : </b>".$prev["direction"]."</p>";
                    } else if ($prev["typeprevision"] == "température") {
                        echo "<p><b>Température : </b>".$prev["temp"]."</p>";
                        echo "<p><b>Ressenti : </b>".$prev["ressenti"]."</p>";
                    }
                    echo "</div>";
                }
                ?>
            </div>
        </div>

