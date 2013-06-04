<?php

include_once(dirname(__FILE__).'/view/head.php');

/*  Page consultée par l'utilisateur
 *  Si $_GET["lieu"] existe, c'est que l'utilisateur souhaite consulter les infos d'un lieu
 *  sinon on le renvoie vers l'accueil 
 */
 
if (!empty($_POST)) {
    include_once("view/bulletin.php");
} else if (isset($_GET["lieu"])) {
	include_once("view/lieu.php");
} else {
	include_once("view/index.php");
}

include_once(dirname(__FILE__).'/view/tail.php');
