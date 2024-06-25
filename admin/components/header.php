<?php
$page_name .= " - Admin";
// Admin CSS
assets_file(_DIR_ . 'css/user/styles.css', 'css');
assets_file(DIR . 'css/styles.css', 'css');
// Global Header
require_once global_file('header');
// Sidebar & navbar
require_once('includes/header.php');
?>
<div class="all-content">