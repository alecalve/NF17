<?php
    
if ($_GET["stats"] == "lieu") {
    include_once(dirname(__FILE__).'/stats_lieu.php');
} else if ($_GET["stats"] == "dep") {
    include_once(dirname(__FILE__).'/stats_departement.php');
} else if ($_GET["stats"] == "reg") {
    include_once(dirname(__FILE__).'/stats_region.php');
} else if ($_GET["stats"] == "global") {
    include_once(dirname(__FILE__).'/stats_global.php');
}

