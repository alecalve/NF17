<?php
include(dirname(__DIR__).'/head.php');
include(dirname(__DIR__).'/head_admin.php');
include_once(dirname(dirname(__DIR__)).'/src/capteur.class.php');
?>
            <div class="well">
                <?php 
                if ($_GET["capteur"] == "affecter") {
                    include_once("view/admin/forms/form_affect_capteur.php");
                } else if ($_GET["capteur"] == "historique") {
                    include_once("view/admin/historique_capteur.php");
                }
                ?>
            </div>
            </div>
<?php
include(dirname(__DIR__).'/tail.php');
?>
