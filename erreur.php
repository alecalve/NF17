<?php

include_once(dirname(__FILE__).'/view/head.php');
 
echo sprintf("<div class='alert'><strong>Erreur critique !</strong> %s</div>", $_GET["msg"]);

include_once(dirname(__FILE__).'/view/tail.php');
