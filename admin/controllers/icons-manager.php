<?php
define('DIR', '../');
require_once('../includes/db.php');
require_once _DIR_ . "includes/Classes/IconsManager.php";

// Add Icon
if (isset($_POST['addIcon'])) {
    $files = isset($_FILES['file']) ? $_FILES['file'] : [];

    if (!count($files)) returnError("Please select at least one file");

    $saved = $icons_manager->add_icons($files);

    $saved['redirect'] = "";

    echo json_encode($saved);
}

// Export Icons 
if (isset($_POST['exportIcons'])) {

    $res = $icons_manager->export_icons();
    if ($res['status'] !== 'success') die(json_encode($res));

    $res = $res['data'];
    $filename = $res['filename'];
    $url = $res['url'];
    // Return Response
    returnSuccess("Icons Exported successfully!", [
        'download' => [
            'filename' => to_slug(SITE_NAME . " icons"),
            'url' => $url
        ]
    ]);
}

// Import Icons
if (isset($_POST['importIcons'])) {
    $file = isset($_FILES['file']) ? $_FILES['file'] : [];
    if (!count($file)) returnError("Please select a file to import");

    $res = $icons_manager->import_icons($file);

    echo json_encode($res);
}

// Edit Icon
if (isset($_POST['editIcon'])) {

    $id = _POST("id");
    $name = _POST("name");
    $prefix = _POST("prefix");
    $content = _POST("content");


    $res = $db->update("icons", [
        "name" => $name,
        "prefix" => $prefix,
        "content" => $content
    ], ['id' => $id]);

    $icons_manager->load();
    if ($res) returnSuccess("Icon updated successfully", ['redirect' => ""]);
    returnError("Failed to update icon");
}
