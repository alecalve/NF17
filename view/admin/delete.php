<?php
include_once(dirname(dirname(dirname(__FILE__))).'/src/lieu.class.php');

if (($_GET["delete"] == "lieu") && (empty($_GET["lieu"]))) {
    include_once("view/admin/forms/form_delete_lieu.php");
} else if (($_GET["delete"] == "lieu") && (!empty($_GET["lieu"]))) {
    $LManager = new LieuManager();
    $LManager->delete($_GET["lieu"]);
    header('Location: admin.php?list=lieu');
}
