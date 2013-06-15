<?php
include(dirname(__DIR__).'/src/lieu.class.php');
include(dirname(__DIR__).'/src/bulletin.class.php');
include(dirname(__DIR__).'/src/capteur.class.php');

$lieux = new LieuManager();
$bulletins = new BulletinManager();
$CManager = new CapteurManager();
$lieu = $lieux->getOne($_GET["lieu"]);
$meteo = $bulletins->getByLocation($_GET["lieu"]);
$capteurs = $CManager->getByLocation($_GET["lieu"]);
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
                    <h1><?php echo $_GET["lieu"]; ?><small><a href="index.php"> retour</a></small></h1>
                    <p>Département : <i><?php echo $departementString; ?></i></p>
                    <p>Capteur(s) : <i><?php echo $capteurString; ?></i></p>
                    <?php include_once(dirname(__FILE__).'/alerts.php')?>
                </div>
                <?php
                if (empty($lieu)) {
                    echo sprintf("<div class='alert alert-error'><strong>Erreur !</strong> Pas de lieu trouvé avec le nom : %s.</div>", $_GET["lieu"]);
                } else if (!empty($meteo)) {
                    foreach($meteo as $bulletin) {
                        $previsions = $bulletins->getPrevisions($bulletin["lieu"], $bulletin["datebulletin"], $bulletin["periode"]);
                        echo "<div class='span12 bulletin' id='".$bulletin["datebulletin"]."-".$bulletin["periode"]."'>";
                        echo "<h4>Bulletin du ".$bulletin["datebulletin"].", ".$bulletin["periode"]."</h4>";
                        foreach($previsions as $prev) {
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
                        echo "</div>";
                    }
                } else if (empty($meteo)) {
                    echo "<div class='alert'><strong>Attention !</strong> Pas de bulletins trouvés pour ce lieu.</div>";
                    echo "</form>";
                }
                
                ?>
            </div>
        </div>
