<?php
define('DIR', '../');
require_once('../includes/db.php');
require_once _DIR_ . "includes/Classes/IconsManager.php";
require_once _DIR_ . "includes/Classes/Delete.php";

$_delete->set([
	'user' => 'users',
	"icon" => "icons"
]);

$_delete->on("icon", function ($delete, $data) {
	global $icons_manager;
	$res = $delete->db->delete("icons", ['id' => $data['id']]);
	$icons_manager->load();
	return returnSuccess("Icon Deleted Successfully!", ['redirect' => ""]);
});

$_delete->init();
