<?php
include(dirname(__FILE__).'/head.php');
include(dirname(__DIR__).'/src/lieu.class.php');
include(dirname(__DIR__).'/src/bulletin.class.php');

$lieu = Lieu::getOne($_GET["lieu"]);
$bulletins = Bulletin::getByLocation($_GET["lieu"]);

?>
		<div class="row">
			<div class="span12">
				<div class="page-header">
					<h1><?php echo $lieu["nom"]; ?><small><a href="index.php"> retour</a></small></h1>
				</div>
				<?php 
				if (!empty($bulletins)) {
					echo "<p>Bulletins : </p>";
					echo "<ul></ul>";
				} else {
					echo "<div class='alert'>";
					echo "<strong>Attention !</strong> Pas de bulletins trouvés pour ce lieu.";
					echo "</div>";
				}
				
				?>
			</div>
		</div>
<?php
include(dirname(__FILE__).'/tail.php');
?>
