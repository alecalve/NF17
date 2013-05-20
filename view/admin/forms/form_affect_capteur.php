<?php
include_once(dirname(dirname(dirname(__DIR__))).'/src/capteur.class.php');
include_once(dirname(dirname(dirname(__DIR__))).'/src/lieu.class.php');
$lieuManager = new LieuManager();
$lieux = $lieuManager->getAll();
$capteurManager = new CapteurManager();
$capteurs = $capteurManager->getUnaffected();
?>
                <form class="form-horizontal text-center" method="post" action="admin.php">
                    <input type="hidden" name="type" value="capteurAffect">
                    <div class="control-group">
                        <label class="control-label" for="id">Capteur :</label>
                        <div class="controls">
                            <select id="id" name="id">
                            <?php 
                            foreach($capteurs as $capteur) {
                                echo sprintf("<option>%s</option>", $capteur["id"]);
                            }
                            ?>                            
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="lieu">Lieu d'affectation :</label>
                        <div class="controls">
                            <select id="lieu" name="lieu">
                            <?php 
                            foreach($lieux as $lieu) {
                                echo sprintf("<option>%s</option>", $lieu["nom"]);
                            }
                            ?>                            
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="genre">Date du début d'affectation :</label>
                        <div class="controls">
                            <input type="text" class="dp1" value="2013-01-01" id="dp1" name="debut">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="genre">Date de fin d'affectation :</label>
                        <div class="controls">
                            <input type="text" class="dp2" value="2013-12-31" id="dp1" name="fin">
                        </div>
                        <button class="btn btn-primary" type="submit">Affecter</button>
                    </div>
                    
                </form>
                <script>
                    $('.dp1').datepicker({
                        format: 'yyyy-mm-dd',
                        weekStart: 1
                    });
                    $('.dp2').datepicker({
                        format: 'yyyy-mm-dd',
                        weekStart: 1
                    });
                </script>
