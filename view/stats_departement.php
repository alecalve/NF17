<?php
include(dirname(__DIR__).'/src/stats.class.php');

$SM = new StatsManager();
$meanTemp = $SM->getMeanTempDep($_GET["dep"], $_GET["start"], $_GET["end"]);
$meanWind = $SM->getMeanWindDep($_GET["dep"], $_GET["start"], $_GET["end"]);


?>
        <div class="row">
            <div class="span12">
                <div class="page-header">
                    <h1><?php echo $_GET["dep"]; ?><small><a href="index.php"> retour</a></small></h1>
                    <p>Statistiques entre le <?php echo $_GET["start"]; ?> et le <?php echo $_GET["end"]; ?></p>
                </div>
                <div class="row">
                    <div class="span6">
                        <?php
                        if (!empty($meanTemp[0]["avg"])) {
                            echo sprintf("<p><b>Température moyenne</b> : %.2f°C</p>", $meanTemp[0]["avg"]);
                        } else {
                            echo "<div class='alert'><strong>Attention !</strong> Pas de prévisions de température trouvées pour ce département durant cette période.</div>";
                        }
                        if (!empty($meanWind[0]["avg"])) {
                            echo sprintf("<p><b>Vitesse moyenne du vent</b> : %.2f km/h</p>", $meanWind[0]["avg"]);
                        } else {
                            echo "<div class='alert'><strong>Attention !</strong> Pas de prévisions de vent trouvées pour ce département durant cette période.</div>";    
                        }
                        ?>
                    </div>
                    <div class="span6">
                        <form target="index.php" method="get">
                            <input type="hidden" name="stats" value="dep">
                            <input type="hidden" name="dep" value="<?php echo $_GET["dep"]; ?>">
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
