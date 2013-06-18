<?php
include_once(dirname(dirname(dirname(__DIR__))).'/src/lieu.class.php');
$LManager = new LieuManager();
$lieux = $LManager->getAll();
?>
    <h3>Supprimer lieu</h3>
    <form method="get" action="admin.php">
        <input type="hidden" name="delete" value="lieu">
        <p>Sélectionnez le lieu :</p>
        <select name="lieu">
        <?php
        foreach($lieux as $lieu) {
            echo sprintf("<option>%s</option>", $lieu["nom"]);
        }
        ?>                            
        </select>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
