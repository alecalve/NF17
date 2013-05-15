<?php 

include_once(dirname((dirname(__DIR__))).'/src/lieu.class.php');
include_once(dirname((dirname(__DIR__))).'/src/bulletin.class.php');
include_once(dirname((dirname(__DIR__))).'/src/capteur.class.php');

echo var_dump($_POST);

if ($_POST["type"] == "lieu") {

} else if ($_POST["type"] == "bulletin") {
	
} else if ($_POST["type"] == "capteurInsert") {
	if ((isset($_POST["id"])) && (isset($_POST["genre"]))) {
		$capteurManager = new CapteurManager();
		$capteurManager->create($_POST["id"], $_POST["genre"]);
		header('Location: admin.php?list=capteur');
	}
} else if ($_POST["type"] == "capteurAffect") {
	if ((isset($_POST["id"])) && (isset($_POST["lieu"])) && (isset($_POST["debut"])) && (isset($_POST["fin"]))) {
		header('Location: admin.php?capteur=historique');
	}
}else {
	header('Location: admin.php');
}	
