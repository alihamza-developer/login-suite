<?php
require_once('includes/db.php');
$page_name = 'Icons Manager';

$CSS_FILES_ = [
    'icons-manager.css'
];

$JS_FILES_ = [
    'icons-manager.js'
];

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
        <div class="icons-collection">


            <?php

            $icons_ = [];
            $icons = $db->select("icons", "*", [], ["order_by" => "id DESC"]);
            foreach ($icons as $icon) {
                $name = $icon['name'];
                $prefix = $icon['prefix'];
                $id = $icon['id'];
                $content = html_entity_decode(htmlspecialchars_decode($icon['content']));

                $icons_[$id] = [
                    "name" => $name,
                    "prefix" => $prefix,
                    "content" => $content,
                    "id" => $id
                ]
            ?>

                <div class="single-icon" data-id="<?= $id ?>">
                    <span class="d-none icon-name"><?= $name ?></span>
                    <div class="icon" title="<?= $name ?>">
                        <?= $content ?>
                    </div>


                    <div class="actions">
                        <span class="single-icon" title="Edit Icon" data-toggle="modal" data-target="#editIconModal"><?= svg_icon("edit") ?></span>

                        <div class="dropdown">
                            <span class="single-icon" data-toggle="dropdown"><?= svg_icon("vertical-dots") ?></span>
                            <div class="dropdown-menu">

                                <div class="dropdown-item download-icon">
                                    <?= svg_icon("download") ?>
                                    Download
                                </div>


                                <div class="dropdown-item copy-icon-content">
                                    <?= svg_icon("copy") ?>
                                    Copy
                                </div>


                                <div class="dropdown-item delete-btn" data-parent=".single-icon" data-target="<?= $id ?>" data-action="icon">
                                    <?= svg_icon("trash") ?>
                                    Delete
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            <?php
            }
            ?>


        </div>
    </div>

</div>

<?php
# Modals
require_once "./components/icons-manager/edit-icon-popup.php";
?>

<script>
    const ICONS = <?= json_encode($icons_) ?>;
</script>
<?php require_once "includes/foot.php"; ?>