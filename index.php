<?php

if (isset($_GET["lieu"])) {
	include_once("view/lieu.php");
} else {
	include_once("view/index.php");
}
