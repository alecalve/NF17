<?php
include(dirname(__FILE__).'/head.php');
include(dirname(__DIR__).'/src/lieu.class.php');

?>
        <div class="row">
			<div class="span12">
				<div class="hero-unit">
					<h2>Bienvenue sur le site de Météo France</h2>
					<p>Voici nos lieux actuellement desservis :</p>
					<ul>
					<?php 
					foreach(Lieu::getAll() as $lieu) {
						if ($lieu["couverture"]) {
							echo sprintf('<li><a href="index.php?lieu=%s">%s</a></li>',$lieu["nom"], $lieu["nom"]);
						}
					}
					?>
					</ul>
					<p>Et ceux qui ne le sont pas :</p>
					<ul>
					<?php 
					foreach(Lieu::getAll() as $lieu) {
						if (!$lieu["couverture"]) {
							echo sprintf('<li><a href="index.php?lieu=%s">%s</a></li>',$lieu["nom"], $lieu["nom"]);
						}
					}
					?>
					</ul>
				</div>
			</div>
        </div>
<?php include(dirname(__FILE__).'/tail.php'); ?>
