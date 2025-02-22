<?php
define('DIR', '../');
require_once('../includes/db.php');
require_once _DIR_ . "includes/Classes/IconsManager.php";
require_once _DIR_ . "includes/Classes/Delete.php";

$_delete->set([
	'user' => 'users'
]);

$_delete->init();
