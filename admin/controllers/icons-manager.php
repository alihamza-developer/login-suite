<?php
define('DIR', '../');
require_once('../includes/db.php');

// Add Icon
if (isset($_POST['addIcon'])) {
    $category_id = _POST('category_id', ['default' => '']);
    $files = isset($_FILES['file']) ? $_FILES['file'] : [];

    if (!count($files)) returnError("Please select at least one file");

    $saved = $icons_manager->add_icons([
        'icons' => $files,
        'category_id' => $category_id
    ]);

    // Load Icons to Site
    $icons_manager->load_icons_to_site();

    echo json_encode($saved);
}


// Add Category
if (isset($_POST['saveCategory'])) {
    $name = _POST('name');
    $id = _POST('id', ['default' => false]);

    $saved = $icons_manager->_category->save([
        'name' => $name,
        'type' => $icons_manager->category_type,
    ]);
    echo json_encode($saved);
}


// Load Icons to Site
if (isset($_POST['loadIconsToSite'])) {
    $icons_manager->load_icons_to_site();
    returnSuccess("Icons loaded successfully!");
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
    $category_id = _POST('category_id');
    if (!count($file)) returnError("Please select a file to import");

    $res = $icons_manager->import_icons($file, $category_id);

    echo json_encode($res);
}
