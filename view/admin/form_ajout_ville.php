<?php
include_once(dirname(dirname(__DIR__)).'/src/locations.class.php');
$locationsManager = new LocationsManager();
$departements = $locationsManager->getDepartements();
?>        
                
                <form class="form-horizontal" method="post" action="admin.php">
                    <input type="hidden" name="type" value="ville">
                    <div class="control-group">
                        <label class="control-label" for="nom">Nom de la ville</label>
                        <div class="controls">
                            <input type="text" id="nom" name="nom">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="departement">Département</label>
                        <div class="controls">
                            <select name="departement">
                            <?php 
                            foreach($departements as $departement) {
                                echo sprintf("<option>%s</option>", $departement["nom"]);
                            }
                            ?>                            
                            </select>
                            
                            <button class="btn btn-primary" type="submit">Continuer</button>
                        </div>
                    </div>
                </form>

