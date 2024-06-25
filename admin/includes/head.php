<?php
$page_name .= " - Admin";
array_unshift($CSS_FILES_, [
    _DIR_ . 'css/styles.css',
    'styles.css'
]);
// Global header
require_once global_file("header");
// Sidebar & Navbar
require_once global_file("sidebar-settings");
require_once('includes/sidebar.php');
require_once('includes/navbar.php');
?>
<div class="all-content">