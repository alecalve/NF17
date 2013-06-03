<?php
include_once(dirname(dirname(dirname(__DIR__))).'/src/prevision.class.php');
$previsionManager = new PrevisionManager();
?>

                <form class="form-horizontal text-center" method="post" action="admin.php">
                    <input type="hidden" name="type" value="previsionAjout2">
                    <input type="hidden" name="capteur" value="<?php echo $_POST["capteur"]; ?>">
                    <input type="hidden" name="date" value="<?php echo $_POST["date"]; ?>">
                    <input type="hidden" name="periode" value="<?php echo $_POST["periode"]; ?>">
                    <div class="control-group">
                        <label class="control-label" for="id">Description :</label>
                        <div class="controls">
                            <textarea cols="40" rows="5" name="descr"></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="direction">Direction :</label>
                        <div class="controls">
                            <select name="direction">
                            <?
                            foreach($previsionManager->getDirections() as $dir) {
                                echo sprintf("<option>%s</option>", $dir["value"]);
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="force">Force :</label>
                        <div class="controls">
                            <input type="number" id="force" name="force">
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Ajouter</button>
                </form>
