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
                        <label class="control-label" for="temp">Température :</label>
                        <div class="controls">
                            <input type="number" id="temp" name="temp">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ressenti">Ressentie :</label>
                        <div class="controls">
                            <input type="number" id="ressenti" name="ressenti">
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit" id="submitForm" disabled="true" >Ajouter</button>
                </form>
                <script>
                function checkForm(){
                                var regex = new RexExp("^[1-9]+$");
                                if(regex.test(document.getElementById("temp")) && regex.test(document.getElementById("ressenti"))){
                                             document.getElementById("submitForm").disabled = false;   
                                }
                                else{
                                 document.getElementById("submitForm").disabled = true;   
                                }
                }
                </script>
