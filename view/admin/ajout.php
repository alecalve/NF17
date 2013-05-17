<?php
include_once(dirname(__DIR__).'/head.php');
include_once(dirname(__DIR__).'/head_admin.php');
?>
			<div class="well">
				<?php 
				if ($_GET["ajout"] == "ville") {
                    include_once("view/admin/form_ajout_ville.php");
                } else if ($_GET["ajout"] == "massif") {
                    include_once("view/admin/form_ajout_massif.php");
				} else if ($_GET["ajout"] == "bulletin") {
					include_once("view/admin/form_ajout_bulletin.php");
				} else if ($_GET["ajout"] == "capteur") {
					include_once("view/admin/form_ajout_capteur.php");
				}
				?>
			</div>
        </div>
<?php include_once(dirname(__DIR__).'/tail.php'); ?>
