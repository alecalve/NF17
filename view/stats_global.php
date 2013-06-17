<?php
include(dirname(__DIR__).'/src/stats.class.php');

if (empty($_GET["temp"])) {
    $_GET["temp"] = "20";
}
if (empty($_GET["vent"])) {
    $_GET["vent"] = "5";
}
if (empty($_GET["start"])) {
    $_GET["start"] = "2013-01-01";
}
if (empty($_GET["end"])) {
    $_GET["end"] = "2013-12-31";
}
if (empty($_GET["marge"])) {
    $_GET["marge"] = "1";
}

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
$maxPreciDep = $SM->getMaxPreciDep($_GET["start"], $_GET["end"]);
$maxPreciLieu = $SM->getMaxPreciLieu($_GET["start"], $_GET["end"]);
$maxPreciReg = $SM->getMaxPreciReg($_GET["start"], $_GET["end"]);
$maxCumuPreciDep = $SM->getMaxCumuPreciDep($_GET["start"], $_GET["end"]);
$maxCumuPreciLieu = $SM->getMaxCumuPreciLieu($_GET["start"], $_GET["end"]);
$maxCumuPreciReg = $SM->getMaxCumuPreciReg($_GET["start"], $_GET["end"]);
$conWindDep = $SM->getConcernedWindDep($_GET["vent"], $_GET["marge"], $_GET["start"], $_GET["end"]);
$conWindLieu = $SM->getConcernedWindLieu($_GET["vent"], $_GET["marge"], $_GET["start"], $_GET["end"]);
$conWindReg = $SM->getConcernedWindReg($_GET["vent"], $_GET["marge"], $_GET["start"], $_GET["end"]);
$conTempDep = $SM->getConcernedTempDep($_GET["temp"], $_GET["marge"], $_GET["start"], $_GET["end"]);
$conTempLieu = $SM->getConcernedTempLieu($_GET["temp"], $_GET["marge"], $_GET["start"], $_GET["end"]);
$conTempReg = $SM->getConcernedTempReg($_GET["temp"], $_GET["marge"], $_GET["start"], $_GET["end"]);


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
                        <?php
                        foreach($maxPreciLieu as $max) {
                            echo sprintf("<p><b>le plus touché en moyenne par la/les %s</b> : %s avec %.2f mm</p>", $max["type"], $max["lieu"], $max["avg"]);
                        }
                        foreach($maxCumuPreciLieu as $cumu) {
                            echo sprintf("<p><b>le plus touché en cumulé par la/les %s</b> : %s avec %.2f mm</p>", $cumu["type"], $cumu["lieu"], $cumu["val"]);
                        }
                        if(!empty($conTempLieu)) {
                            echo sprintf("<p><b>avec une température de %d ± %.1f°C</b> : %s avec %.2f°C</p>",
                                         $_GET["temp"], $_GET["marge"], $conTempLieu[0]["lieu"], $conTempLieu[0]["avg"]);
                        }
                        if(!empty($conWindLieu)) {
                            echo sprintf("<p><b>avec un vent de %d ± %.1f km/h</b> : %s avec %.2f km/h</p>",
                                         $_GET["vent"], $_GET["marge"], $conWindLieu[0]["lieu"], $conWindLieu[0]["avg"]);
                        }
                        ?>
                        <h2>Département</h2>
                        <p><b>le plus froid</b> : <?php echo $minTempDep[0]["lieu"]; ?> avec <?php echo sprintf("%.2f", $minTempDep[0]["avg"]); ?>°C</p>
                        <p><b>le plus chaud</b> : <?php echo $maxTempDep[0]["lieu"]; ?> avec <?php echo sprintf("%.2f", $maxTempDep[0]["avg"]); ?>°C</p>
                        <p><b>le plus venteux</b> : <?php echo $maxWindDep[0]["lieu"]; ?> avec <?php echo sprintf("%.2f", $maxWindDep[0]["avg"]); ?> km/h</p>
                        <?php
                        foreach($maxPreciDep as $max) {
                            echo sprintf("<p><b>le plus touché en moyenne par la/les %s</b> : %s avec %.2f mm</p>", $max["type"], $max["lieu"], $max["avg"]);
                        }
                        foreach($maxCumuPreciDep as $cumu) {
                            echo sprintf("<p><b>le plus touché en cumulé par la/les %s</b> : %s avec %.2f mm</p>", $cumu["type"], $cumu["lieu"], $cumu["val"]);
                        }
                        if(!empty($conTempDep)) {
                            echo sprintf("<p><b>avec une température de %d +/- %.1f°C</b> : %s avec %.2f°C</p>",
                                         $_GET["temp"], $_GET["marge"], $conTempDep[0]["lieu"], $conTempDep[0]["avg"]);
                        }
                        if(!empty($conWindDep)) {
                            echo sprintf("<p><b>avec un vent de %d ± %.1f km/h</b> : %s avec %.2f km/h</p>",
                                         $_GET["vent"], $_GET["marge"], $conWindDep[0]["lieu"], $conWindDep[0]["avg"]);
                        }
                        ?>
                        <h2>Région</h2>
                        <p><b>le plus froid</b> : <?php echo $minTempRegion[0]["lieu"]; ?> avec <?php echo sprintf("%.2f", $minTempRegion[0]["avg"]); ?>°C</p>
                        <p><b>le plus chaud</b> : <?php echo $maxTempRegion[0]["lieu"]; ?> avec <?php echo sprintf("%.2f", $maxTempRegion[0]["avg"]); ?>°C</p>
                        <p><b>le plus venteux</b> : <?php echo $maxWindRegion[0]["lieu"]; ?> avec <?php echo sprintf("%.2f", $maxWindRegion[0]["avg"]); ?> km/h</p>
                        <?php
                        foreach($maxPreciReg as $max) {
                            echo sprintf("<p><b>le plus touché en moyenne par la/les %s</b> : %s avec %.2f mm</p>", $max["type"], $max["lieu"], $max["avg"]);
                        }
                        foreach($maxCumuPreciReg as $cumu) {
                            echo sprintf("<p><b>le plus touché en cumulé par la/les %s</b> : %s avec %.2f mm</p>", $cumu["type"], $cumu["lieu"], $cumu["val"]);
                        }
                        if(!empty($conTempReg)) {
                            echo sprintf("<p><b>avec une température de %d +/- %.1f°C</b> : %s avec %.2f°C</p>",
                                         $_GET["temp"], $_GET["marge"], $conTempReg[0]["lieu"], $conTempReg[0]["avg"]);
                        }
                        if(!empty($conWindReg)) {
                            echo sprintf("<p><b>avec un vent de %d ± %.1f km/h</b> : %s avec %.2f km/h</p>",
                                         $_GET["vent"], $_GET["marge"], $conWindReg[0]["lieu"], $conWindReg[0]["avg"]);
                        }
                        ?>
                    </div>
                    <div class="span6">
                        <form target="index.php" method="get">
                            <input type="hidden" name="stats" value="global">
                            <h4>Changer les bornes temporelles, de température et de vent</h4>
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
                            <div class="control-group">
                                <label class="control-label" for="temp">Température:</label>
                                <div class="controls">
                                    <input type="text" value="<?php echo $_GET["temp"]; ?>" id="temp" name="temp">
                                </div>
                                <label class="control-label" for="vent">Vent :</label>
                                <div class="controls">
                                    <input type="text" value="<?php echo $_GET["vent"]; ?>" id="vent" name="vent">
                                </div>
                                <label class="control-label" for="marge">Marge:</label>
                                <div class="controls">
                                    <input type="text" value="<?php echo $_GET["marge"]; ?>" id="marge" name="marge">
                                </div>
                            </div>
                        <button class="btn btn-primary" id="submitForm" type="submit">Continuer</button>
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
                <script>
               /* document.getElementById("temp").onkeyup = function(){
                    var regex = /^-?[1-9]+$/;
                    if(regex.test(document.getElementById("temp").value) && regex.test(document.getElementById("ressenti").value)){
                        document.getElementById("submitForm").disabled = false;   
                    } else {
                        document.getElementById("submitForm").disabled = true;   
                    }
                }
                
                document.getElementById("vent").onkeyup = function(){
                    var regex = /^[1-9]+(\.[1-9]{2})?$/;
                    if(regex.test(document.getElementById("temp").value) && regex.test(document.getElementById("ressenti").value)){
                        document.getElementById("submitForm").disabled = false;   
                    } else {
                        document.getElementById("submitForm").disabled = true;   
                    }
                }
                
                document.getElementById("marge").onkeyup = function(){
                    var regex = /^[1-9]+(\.[1-9]{2})?$/;
                    if(regex.test(document.getElementById("temp").value) && regex.test(document.getElementById("ressenti").value)){
                        document.getElementById("submitForm").disabled = false;   
                    } else {
                        document.getElementById("submitForm").disabled = true;   
                    }
                }*/

                </script>

