<?php
$baseUrl = "http://".$_SERVER['HTTP_HOST']."/cms/epanel/";
define('baseUrl',$baseUrl);
define('loginUrl',baseUrl."login.php");
define('homeUrl',baseUrl."dashboard.php");
define('DR',$_SERVER['DOCUMENT_ROOT']."/cms/epanel/");