<?php
include(dirname(__FILE__).'/head.php');
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
                </div>
                <?php 
                
                if (empty($lieu)) {
                    echo sprintf("<div class='alert alert-error'><strong>Erreur !</strong> Pas de lieu trouvé avec le nom : %s.</div>", $_GET["lieu"]);
                } else if (!empty($meteo)) {
                    echo "<p>Bulletins : </p>";
                    echo "<ul></ul>";
                } else {
                    echo "<div class='alert'><strong>Attention !</strong> Pas de bulletins trouvés pour ce lieu.</div>";
                }
                
                ?>
            </div>
        </div>
<?php
include(dirname(__FILE__).'/tail.php');
?>
