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
                    echo "<ul>";
                    echo "<li>Type de prévision : ".$prev["typeprevision"]."</li>";
                    echo "<li>Description : ".$prev["description"]."</li>";
                    if ($prev["typeprevision"] == "vent") {
                        echo "<li>Force du vent : ".$prev["force"]."</li>";
                        echo "<li>Direction : ".$prev["direction"]."</li>";
                    } else if ($prev["typeprevision"] == "température") {
                        echo "<li>Température : ".$prev["temp"]."</li>";
                        echo "<li>Ressenti : ".$prev["ressenti"]."</li>";
                    }
                    echo "</ul>";
                    echo "</div>";
                    
                }
                ?>
            </div>
        </div>

