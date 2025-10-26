<?php
require "db.php";
require "auth.php";
// $indexPage = "/vscode-sftps/nest.prdn.net/smapes";
$indexPage = "/smapes";

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$currentUrl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
// echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
