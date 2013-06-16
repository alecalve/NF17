<?php

include_once(dirname(__FILE__).'/view/head.php');

/*  Page consultée par l'utilisateur
 *  Si $_GET["lieu"] existe, c'est que l'utilisateur souhaite consulter les infos d'un lieu
 *  sinon on le renvoie vers l'accueil 
 */
 
if (isset($_GET["lieu"])) {
	include_once("view/lieu.php");
} else if (isset($_GET["stats"])) {
	include_once("view/stats.php");
} else {
	include_once("view/index.php");
}

include_once(dirname(__FILE__).'/view/tail.php');
