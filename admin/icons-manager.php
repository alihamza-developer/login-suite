<?php
require_once('includes/db.php');
$page_name = 'Icons Manager';
require_once "includes/head.php";
?>

<div class="card">
    <div class="card-header">
        <div class="pull-away">
            <span>Icons Manager</span>
            <?php require_once "components/icons-manager/buttons.php" ?>
        </div>
    </div>

    <!-- Tabs Area -->
    <div class="card-body">
        <?php require_once "components/icons-manager/tabs.php"; ?>
    </div>

</div>

<?php
# Modals
require_once 'components/icons-manager/add-icon-popup.php';
require_once 'components/icons-manager/add-category-popup.php';
?>

<?php require_once "includes/foot.php"; ?>