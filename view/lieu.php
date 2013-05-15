<?php
include(dirname(__FILE__).'/head.php');
include(dirname(__DIR__).'/src/lieu.class.php');
include(dirname(__DIR__).'/src/bulletin.class.php');

$lieux = new LieuManager();
$bulletins = new BulletinManager();
$lieu = $lieux->getOne($_GET["lieu"]);
$meteo = $bulletins->getByLocation($_GET["lieu"]);

?>
		<div class="row">
			<div class="span12">
				<div class="page-header">
					<h1><?php echo $_GET["lieu"]; ?><small><a href="index.php"> retour</a></small></h1>
				</div>
				<?php 
				
				if (empty($lieu)) {
					echo sprintf("<div class='alert alert-error'><strong>Erreur !</strong> Pas de lieu trouvé avec le nom : %s.</div>", $_GET["lieu"]);
				} else if (!empty($meteo)) {
					echo "<p>Bulletins : </p>";
					echo "<ul></ul>";
				} else {
					echo "<div class='alert'><strong>Attention !</strong> Pas de bulletins trouvés pour ce lieu.</div>";
				}
				
				?>
			</div>
		</div>
<?php
include(dirname(__FILE__).'/tail.php');
?>
