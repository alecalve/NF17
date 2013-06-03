<?php
include_once(dirname(dirname(dirname(__DIR__))).'/src/prevision.class.php');
include_once(dirname(dirname(dirname(__DIR__))).'/src/lieu.class.php');
$PManager = new PrevisionManager();
$LManager = new LieuManager();

?>
                <form class="form-horizontal text-center" method="post" action="admin.php">
                    <input type="hidden" name="type" value="bulletinInsert">
                    <div class="control-group">
                        <label class="control-label" for="periode">Période du bulletin</label>
                        <div class="controls">
                            <select id="periode" name="periode">
                            <?php 
                            foreach($PManager->getPeriodes() as $type) {
                                echo sprintf("<option>%s</option>", $type["value"]);
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="lieu">Lieu</label>
                        <div class="controls">
                            <select id="lieu" name="lieu">
                            <?php 
                            foreach($LManager->getCovered() as $type) {
                                echo sprintf("<option>%s</option>", $type["nom"]);
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

