<?php
include_once(dirname(dirname(dirname(__DIR__))).'/src/capteur.class.php');
include_once(dirname(dirname(dirname(__DIR__))).'/src/lieu.class.php');
include_once(dirname(dirname(dirname(__DIR__))).'/src/prevision.class.php');
?>
                <form class="form-horizontal text-center" method="post" action="admin.php">
                    <input type="hidden" name="type" value="previsionAjout2">
                    <div class="control-group">
                        <label class="control-label" for="id">Période :</label>
                        <div class="controls">
                            <textarea cols="40" rows="5" name="descr"></textarea>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Continuer</button>
                </form>
