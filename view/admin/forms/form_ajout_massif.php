<?php
include_once(dirname(dirname(dirname(__DIR__))).'/src/locations.class.php');
$locationsManager = new LocationsManager();
$departements = $locationsManager->getDepartements();
?>        
                
                <form class="form-horizontal" method="post" action="admin.php">
                    <input type="hidden" name="type" value="massif">
                    <div class="control-group">
                        <label class="control-label" for="nom">Nom du massif</label>
                        <div class="controls">
                            <input type="text" id="nom" name="nom">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="departements">Département(s)</label>
                        <div class="controls">
                            <select name="departements" multiple>
                            <?php 
                            foreach($departements as $departement) {
                                echo sprintf("<option value='%s'>%s - %s</option>",$departement["nom"], $departement["numero"], $departement["nom"]);
                            }
                            ?>                            
                            </select>
                            
                            <button class="btn btn-primary" type="submit">Ajouter</button>
                        </div>
                    </div>
                </form>

