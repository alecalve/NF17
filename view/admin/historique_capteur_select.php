    <h3>Voir historique</h3>
    <form method="get" action="admin.php">
        <input type="hidden" name="capteur" value="historique">
        <p>Sélectionnez le capteur :</p>
        <select name="id">
        <?php
        $capteurManager = new CapteurManager();
        $capteurs = $capteurManager->getAll();
        foreach($capteurs as $capteur) {
            echo sprintf("<option>%s</option>", $capteur["id"]);
        }
        ?>                            
        </select>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
