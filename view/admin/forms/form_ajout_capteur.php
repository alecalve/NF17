<?php
include_once(dirname(dirname(dirname(__DIR__))).'/src/capteur.class.php');
$capteurManager = new CapteurManager();
$typeCapteur = $capteurManager->getTypeCapteurs();
?>
                <form class="form-horizontal text-center" method="post" action="admin.php">
                    <input type="hidden" name="type" value="capteurInsert">
                    <div class="control-group">
                        <label class="control-label" for="id">ID du capteur</label>
                        <div class="controls">
                            <input type="text" id="id" name="id">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="genre">Type du capteur</label>
                        <div class="controls">
                            <select id="genre" name="genre">
                            <?php 
                            foreach($typeCapteur as $type) {
                                echo sprintf("<option>%s</option>", $type["value"]);
                            }
                            ?>                            
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Créer</button>
                </form>
