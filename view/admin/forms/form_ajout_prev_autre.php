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
                    <button class="btn btn-primary" type="submit">Ajouter</button>
                </form>
