<?php
include(dirname(__DIR__).'/src/stats.class.php');

$SM = new StatsManager();
$maxTempDep = $SM->getMaxTempDep($_GET["start"], $_GET["end"]);
$minTempDep = $SM->getMinTempDep($_GET["start"], $_GET["end"]);
$maxTempLieu = $SM->getMaxTempLieu($_GET["start"], $_GET["end"]);
$minTempLieu = $SM->getMinTempLieu($_GET["start"], $_GET["end"]);
$maxTempRegion = $SM->getMaxTempReg($_GET["start"], $_GET["end"]);
$minTempRegion = $SM->getMinTempReg($_GET["start"], $_GET["end"]);
$maxWindDep = $SM->getMaxWindDep($_GET["start"], $_GET["end"]);
$maxWindLieu = $SM->getMaxWindLieu($_GET["start"], $_GET["end"]);
$maxWindRegion = $SM->getMaxWindReg($_GET["start"], $_GET["end"]);


?>
        <div class="row">
            <div class="span12">
                <div class="page-header">
                    <h1>Statistiques globales <small><a href="index.php"> retour</a></small></h1>
                    <p>Entre le <?php echo $_GET["start"]; ?> et le <?php echo $_GET["end"]; ?></p>
                </div>
                <div class="row">
                    <div class="span6">
                        <h2>Lieux</h2>
                        <p><b>le plus froid</b> : <?php echo $minTempLieu[0]["lieu"]; ?> avec <?php echo sprintf("%.2f", $minTempLieu[0]["avg"]); ?>°C</p>
                        <p><b>le plus chaud</b> : <?php echo $maxTempLieu[0]["lieu"]; ?> avec <?php echo sprintf("%.2f", $maxTempLieu[0]["avg"]); ?>°C</p>
                        <p><b>le plus venteux</b> : <?php echo $maxWindLieu[0]["lieu"]; ?> avec <?php echo sprintf("%.2f", $maxWindLieu[0]["avg"]); ?> km/h</p>
                        <h2>Département</h2>
                        <p><b>le plus froid</b> : <?php echo $minTempDep[0]["lieu"]; ?> avec <?php echo sprintf("%.2f", $minTempDep[0]["avg"]); ?>°C</p>
                        <p><b>le plus chaud</b> : <?php echo $maxTempDep[0]["lieu"]; ?> avec <?php echo sprintf("%.2f", $maxTempDep[0]["avg"]); ?>°C</p>
                        <p><b>le plus venteux</b> : <?php echo $maxWindDep[0]["lieu"]; ?> avec <?php echo sprintf("%.2f", $maxWindDep[0]["avg"]); ?> km/h</p>
                        <h2>Région</h2>
                        <p><b>le plus froid</b> : <?php echo $minTempRegion[0]["lieu"]; ?> avec <?php echo sprintf("%.2f", $minTempRegion[0]["avg"]); ?>°C</p>
                        <p><b>le plus chaud</b> : <?php echo $maxTempRegion[0]["lieu"]; ?> avec <?php echo sprintf("%.2f", $maxTempRegion[0]["avg"]); ?>°C</p>
                        <p><b>le plus venteux</b> : <?php echo $maxWindRegion[0]["lieu"]; ?> avec <?php echo sprintf("%.2f", $maxWindRegion[0]["avg"]); ?> km/h</p>
                    </div>
                    <div class="span6">
                        <form target="index.php" method="get">
                            <input type="hidden" name="stats" value="global">
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
                    </div>
                </div>
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
