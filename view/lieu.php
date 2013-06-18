<?php
include(dirname(__DIR__).'/src/lieu.class.php');
include(dirname(__DIR__).'/src/bulletin.class.php');
include(dirname(__DIR__).'/src/capteur.class.php');

if (empty($_GET["start"])) {
    $_GET["start"] = "2013-01-01";
}
if (empty($_GET["end"])) {
    $_GET["end"] = "2013-12-31";
}
$lieux = new LieuManager();
$bulletins = new BulletinManager();
$CManager = new CapteurManager();
$lieu = $lieux->getOne($_GET["lieu"]);
$meteo = $bulletins->getByLocation($_GET["lieu"], $_GET["start"], $_GET["end"]);
$capteurs = $CManager->getByLocation($_GET["lieu"]);
$capteurString = "";

if (empty($capteurs)) {
    $capteurString = "Pas de capteurs affectés à ce lieu.";
}

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
                    <div class="row">
                        <div class="span8">
                            <p>Département : <i><?php echo $departementString; ?></i></p>
                            <p>Capteur(s) : <i><?php echo $capteurString; ?></i></p>
                        </div>
                        <div class="span4">
                            <p><b>Météo entre le <?php echo $_GET["start"]; ?> et le <?php echo $_GET["end"]; ?></b></p>
                            <p><small><a href=<?php echo "'index.php?stats=lieu&lelieu=".$_GET['lieu']."&start=".$_GET['start']."&end=".$_GET['end']."'" ?>>Statistiques sur cette période</a></small></p>
                        </div>
                    </div>
                    <?php include_once(dirname(__FILE__).'/alerts.php')?>
                </div>
                <div class="row">
                    <div class="span8">
                        <?php
                        if (empty($lieu)) {
                            echo sprintf("<div class='alert alert-error'><strong>Erreur !</strong> Pas de lieu trouvé avec le nom : %s.</div>", $_GET["lieu"]);
                        } else if (!empty($meteo)) {
                            foreach($meteo as $bulletin) {
                                $previsions = $bulletins->getPrevisions($bulletin["lieu"], $bulletin["datebulletin"], $bulletin["periode"]);
                                echo "<div class='row'>";
                                echo "<h4>Bulletin du ".$bulletin["datebulletin"].", ".$bulletin["periode"]."</h4>";
                                foreach($previsions as $prev) {
                                    echo "<div class='span2'>";
                                    echo "<p><b>Prévision</b> : ".$prev["typeprevision"]."</p>";
                                    echo "<p><b>Description</b> :<br>".$prev["description"]."</p>";
                                    if ($prev["typeprevision"] == "vent") {
                                        echo "<p><b>Force du vent : </b>".$prev["force"]." km/h</p>";
                                        echo "<p><b>Direction : </b>".$prev["direction"]."</p>";
                                    } else if ($prev["typeprevision"] == "température") {
                                        echo "<p><b>Température : </b>".$prev["temp"]."°C</p>";
                                        echo "<p><b>Ressenti : </b>".$prev["ressenti"]."°C</p>";
                                    } else if ($prev["typeprevision"] == "précipitations") {
                                        echo "<p><b>Hauteur : </b>".$prev["hauteur"]." mm</p>";
                                        echo "<p><b>Type : </b>".$prev["typeprecipitation"]."</p>";
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
                    <div class="span4">
                        <form target="index.php" method="get">
                            <input type="hidden" name="lieu" value="<?php echo $_GET["lieu"]; ?>">
                            <h4>Changer les bornes temporelles</h4>
                            <div class="control-group">
                                <label class="control-label" for="date1">Date de départ :</label>
                                <div class="controls">
                                    <input type="text" value="<?php echo $_GET["start"]; ?>" id="date1" name="start">
                                </div>
                                <label class="control-label" for="date2">Date de fin :</label>
                                <div class="controls">
                                    <input type="text" value="<?php echo $_GET["end"]; ?>" id="date2" name="end">
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Continuer</button>
                        </form>
                        <script>
                            $('#date1').datepicker({
                                format: 'yyyy-mm-dd',
                                weekStart: 1
                            });
                            $('#date2').datepicker({
                                format: 'yyyy-mm-dd',
                                weekStart: 1
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
