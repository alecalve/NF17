<?php
include(dirname(__FILE__).'/head.php');
?>
        <div class="row">
			<div class="span12">
				<div class="hero-unit">
					<h2>Bienvenue sur le site de Météo France</h2>
					<ul class="nav nav-pills">
						<li><a href="index.php">Vue utilisateur</a></li>
						<li class="active"><a href="admin.php">Vue administration</a></li>
					</ul>
				</div>
			</div>
			<div class="span2 well">
			    <ul class="nav nav-list">
					<li class="nav-header">Lieux</li>
					<li><a href="#">Ajouter</a></li>
					<li><a href="#">Supprimer</a></li>
					<li class="nav-header">Bulletin</li>
					<li><a href="#">Ajouter</a></li>
					<li><a href="#">Supprimer</a></li>
				</ul>
			</div>
			<div class="span9 well">
				<h3>Contenu</h3>
			</div>
			
        </div>
<?php include(dirname(__FILE__).'/tail.php'); ?>
