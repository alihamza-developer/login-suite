<?php
require_once(DIR . 'includes/Classes/Extension.php');

// Upload Image
if (is_post('uploadImage', true)) {
    $type = _POST('type', ['default' => '']);
    // set path
    $path = "uploads";
    $res_filename = "";
    if ($type == 'user') $path = 'users';
    $folder_path = _DIR_ . 'images/' . $path;

    // upload file
    $file = $_FILES['image']['tmp_name'];
    $props = getimagesize($file);
    $width = isset($props[0]) ? $props[0] : 0;
    $height = isset($props[1]) ? $props[1] : 0;
    if ($width > 700 || $height > 700) {
        returnError("Image size should be less than 700x700");
    }

    $file = $_fn->upload_file('image', [
        'path' => $folder_path,
        'allowed_exts' => ['jpg', 'jpeg'],
        'max_size' => '1mb',
    ]);

    if ($file['status'] != 'success') returnError($file['data']);

    $res_filename = $file['filename'];
    // generate new file 
    $new_file_name = generate_file_name("webp", $folder_path, false, 15);
    $new_file_path = merge_path($folder_path, $new_file_name);
    $sourceImagePath = $file['filepath'];

    // Compress an image from a file
    $res = $_ext->execute('python::compress-image', [
        "file" => merge_path("../../", "images/", $path, $file['filename']),
        "newFile" => merge_path("../../", "images/",  $path, $new_file_name),
        "quality" => $type == 'category' ? 80 : 40
    ]);

    // remove extra spaces from res 
    if (is_file($new_file_path)) {
        $file_url = url('images/', $path, $new_file_name);
        @unlink($file['filepath']);
        $res_filename = $new_file_name;
    } else
        returnError("Error while uploading image. Please try again");


    returnSuccess([
        'url' => $file_url,
        'filename' => $res_filename
    ]);
}
