<?php
include_once(dirname(__DIR__).'/src/lieu.class.php');
include_once(dirname(__DIR__).'/src/alert.class.php');

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
				<div class="row">
                    <?php include_once(dirname(__FILE__).'/alerts.php')?>
                    <p><small><a href="index.php?stats=global&start=2013-01-01&end=2013-12-31">Statistiques globales</a></small></p>
					<p>Voici nos lieux actuellement desservis :</p>
					<?php 
					foreach($lieux->getAll() as $lieu) {
						if ($lieu['couverture']) {
							echo sprintf("<div class='span6 lieu text-center'><a href='index.php?lieu=%s'>%s</a></div>",$lieu['nom'], $lieu['nom']);
						}
					}
					?>
                </div>
                <div class="row">
					<p>Et ceux qui ne le sont pas :</p>
					<?php 
					foreach($lieux->getAll() as $lieu) {
						if (!$lieu['couverture']) {
							echo sprintf("<div class='span6 lieu text-center'><a href='index.php?lieu=%s'>%s</a></div>",$lieu['nom'], $lieu['nom']);
						}
					}
					?>
                </div>
			</div>
