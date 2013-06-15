<?php
if ($_GET["stats"] = "lieu") {
    include_once(dirname(__FILE__).'/stats_lieu.php');
} else if ($_GET["stats"] = "departement") {
    include_once(dirname(__FILE__).'/stats_departement.php');
} else if ($_GET["stats"] = "region") {
    include_once(dirname(__FILE__).'/stats_region.php');
} 

