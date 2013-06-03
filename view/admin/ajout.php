<?php

/*  Cette page est appelée quand l'utilisateur souhaite remplir un formulaire d'ajout
 *  En fonction du type de l'objet à ajouter, on inclue le formulaire HTML correspondant
 */
?>
            <div class="well">
                <?php 
                if ($_GET["ajout"] == "ville") {
                    include_once("view/admin/forms/form_ajout_ville.php");
                } else if ($_GET["ajout"] == "massif") {
                    include_once("view/admin/forms/form_ajout_massif.php");
                } else if ($_GET["ajout"] == "bulletin") {
                    include_once("view/admin/forms/form_ajout_bulletin.php");
                } else if ($_GET["ajout"] == "capteur") {
                    include_once("view/admin/forms/form_ajout_capteur.php");
                } else if ($_GET["ajout"] == "prevision") {
                    include_once("view/admin/forms/form_ajout_prevision.php");
                }
                ?>
            </div>
        </div>
