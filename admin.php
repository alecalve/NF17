<?php

/*  Page appelée pour accèder à l'administration
 *  Si $_GET["ajout"] existe, c'est qu'on veut créer un objet d'un type donné dans la BDD
 *  Si $_GET["delete"] existe, c'est qu'on veut supprimer un objet d'un type donné dans la BDD
 *  Si $_GET["list"] existe, c'est qu'on veut lister les objets d'un type donné dans la BDD
 *  Si $_POST existe, c'est que l'utilisateur vient de remplir un formulaire
 *  Sinon, on affiche l'accueil de l'administration
 */
 
if (isset($_GET["ajout"])) {
    include_once("view/admin/ajout.php");
} else if (isset($_GET["delete"])) {
    include_once("view/admin/delete.php");
} else if (isset($_GET["capteur"])) {
    include_once("view/admin/capteur.php");
} else if (isset($_GET["list"])) {
    include_once("view/admin/list.php");
}else if (!empty($_POST)) {
    include_once("view/admin/forms.php");
} else {
    include_once("view/admin.php");
}
