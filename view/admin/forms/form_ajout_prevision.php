<?php
include_once(dirname(dirname(dirname(__DIR__))).'/src/capteur.class.php');
include_once(dirname(dirname(dirname(__DIR__))).'/src/lieu.class.php');
include_once(dirname(dirname(dirname(__DIR__))).'/src/prevision.class.php');
$lieuManager = new LieuManager();
$lieux = $lieuManager->getAll();
$capteurManager = new CapteurManager();
$capteurs = $capteurManager->getAffected();
$previsionManager = new PrevisionManager();
?>
                <form class="form-horizontal text-center" method="post" action="admin.php">
                    <input type="hidden" name="type" value="previsionAjout1">
                    <div class="control-group">
                        <label class="control-label" for="id">Période :</label>
                        <div class="controls">
                            <select name="periode">
                            <?php 
                            foreach($previsionManager->getPeriodes() as $periode) {
                                echo sprintf("<option>%s</option>", $periode["value"]);
                            }
                            ?>                            
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="id">Capteur émetteur:</label>
                        <div class="controls">
                            <select name="capteur">
                            <?php 
                            foreach($capteurs as $capteur) {
                                $lieu = $capteurManager->getLocation($capteur["id"]);
                                echo sprintf("<option value='%s'>%s - %s</option>", $capteur["id"], $lieu, $capteur["id"]);
                            }
                            ?>                            
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="date">Date :</label>
                        <div class="controls">
                            <input type="text" value="2013-01-01" id="date" name="date">
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Continuer</button>
                </form>
                <script>
                    $('#date').datepicker({
                        format: 'yyyy-mm-dd',
                        weekStart: 1
                    });
                </script>
