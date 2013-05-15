<?php

if (isset($_GET["ajout"])) {
    include_once("view/admin/ajout.php");
} else if (isset($_GET["delete"])) {
    include_once("view/admin/delete.php");
} else if (isset($_GET["capteur"])) {
    include_once("view/admin/capteur.php");
} else if (isset($_GET["list"])) {
    include_once("view/admin/list.php");
}else if (!empty($_POST)) {
    include_once("view/admin/form_admin.php");
} else {
    include_once("view/admin.php");
}
