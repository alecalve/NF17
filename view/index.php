<?php
include_once(dirname(__FILE__).'/head.php');
include_once(dirname(__DIR__).'/src/lieu.class.php');

$lieux = new LieuManager();
?>
        <div class="row">
			<div class="span12">
				<div class="hero-unit">
					<h2>Bienvenue sur le site de Météo NF17</h2>
					<ul class="nav nav-pills">
						<li class="active"><a href="index.php">Vue utilisateur</a></li>
						<li><a href="admin.php">Vue administration</a></li>
					</ul>
				</div>
				<div class="well">
					<p>Voici nos lieux actuellement desservis :</p>
					<ul>
					<?php 
					foreach($lieux->getAll() as $lieu) {
						if ($lieu['couverture']) {
							echo sprintf('<li><a href="index.php?lieu=%s">%s</a></li>',$lieu['nom'], $lieu['nom']);
						}
					}
					?>
					</ul>
					<p>Et ceux qui ne le sont pas :</p>
					<ul>
					<?php 
					foreach($lieux->getAll() as $lieu) {
						if (!$lieu['couverture']) {
							echo sprintf('<li><a href="index.php?lieu=%s">%s</a></li>',$lieu['nom'], $lieu['nom']);
						}
					}
					?>
					</ul>
				</div>
			</div>
        </div>
<?php include_once(dirname(__FILE__).'/tail.php'); ?>
