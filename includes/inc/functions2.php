<?php

// Check if user login
function login_user($data)
{
    global $db;
    $key = $data['session_key'];
    $user_table = $data['user_table'];
    $user_id = arr_val($_SESSION, $key);
    if (!$user_id)
        return null;
    $user = $db->select_one($user_table, '*', ['id' => $user_id]);
    if (!$user) {
        unset($_SESSION[$key]);
        return null;
    }
    return $user;
}
// Check if is admin
function is_admin()
{
    if (!LOGGED_IN_USER) return false;
    $admin = LOGGED_IN_USER['is_admin'] == 1 ? true : false;
    return $admin;
}
// Global CSS Files
function global_file($filename)
{
    $filename = rtrim($filename, '.php') . ".php";
    return _DIR_ . "components/global/" . $filename;
}
// CSS & JS file
function assets_file($file, $type, $attach_path = null)
{
    if (is_array($file)) {
        // Multiple files
        foreach ($file as $single_file) {
            assets_file($single_file, $type, $attach_path);
        }
        return true;
    }
    // Single file
    if (
        !strstr($file, 'http') &&
        !strstr($file, '//') &&
        !strstr($file, './')
    ) {
        $file = _rtrim($file, ".$type") . ".$type";
        $file .= ASSETS_V;
        $attach_path = is_null($attach_path) ? '' : $attach_path;
        $file = merge_path($attach_path, $file);
    }
    if ($type === 'css') {
        echo "
        <link rel='stylesheet' href='$file'>";
    } elseif ($type === 'js') {
        echo "
            <script src='$file'></script>";
    }
}
// show message page
function showMsgPage($options)
{
    extract($options);
    $returnData = arr_val($options, 'return');
    if ($returnData) {
        ob_start();
        include _DIR_ . "components/msg.php";
        $contents = ob_get_contents();
        ob_get_clean();
        return $contents;
    }
    require(_DIR_ . "components/msg.php");

    $exit = arr_val($options, 'exit', true);
    if ($exit)
        die();
}
// Error Msg Page
function errorMsgPage($msg = "Error Please Try Again!", $options = [])
{
    $options['exit'] = true;
    $options['msg'] = $msg;
    $options['type'] = 'error';
    showMsgPage($options);
}
// success Msg Page
function successMsgPage($msg, $options = [])
{
    $options['exit'] = true;
    $options['msg'] = $msg;
    $options['type'] = 'success';
    showMsgPage($options);
}
// JS Message
function js_msg($type, $msg, $heading = null)
{
    if (is_null($heading)) $heading = $type;
    $options = [
        'type' => $type
    ];
    return "sAlert('$msg', '$heading', " . json_encode($options) . ")";
}
// Is Image File
function is_image_file($file_name)
{
    $allowed_ext = array('jpg', 'jpeg', 'png', 'gif', 'jfif');
    $getExt = explode('.', $file_name);
    $ext = strtolower(end($getExt));
    if (in_array($ext, $allowed_ext)) {
        return $ext;
    } else {
        return false;
    }
}
// Get current url
function get_current_url()
{
    $url = "http";
    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
        $url .= "s";
    }
    $url .= "://";
    $url .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    return $url;
}

// check if parameter in request
function is_request_param($type, $param_name, $user_auth = false)
{
    $value = false;
    if ($type === "POST") $value = isset($_POST[$param_name]);
    else if ($type === "GET") $value = isset($_GET[$param_name]);
    else if ($type === "FILES") $value = isset($_FILES[$param_name]);
    if (!$value) return false;
    if ($user_auth) {
        if (!LOGGED_IN_USER) return false;
    }
    return true;
}
// Check if parameter in post request
function is_post($param_name, $user_auth = false)
{
    return is_request_param("POST", $param_name, $user_auth);
}

// convert https url to www
function get_www_url($url)
{
    // Remove the 'https://' part if it exists
    $url = preg_replace('#^https?://#', '', $url);

    // Add 'www.' if it doesn't already exist
    if (strpos($url, 'www.') !== 0) {
        $url = 'www.' . $url;
    }

    // Remove trailing slashes
    $url = rtrim($url, '/');

    return $url;
}

// Create Slug
function to_slug($title)
{
    $title = to_title_case($title); // Convert To Title Case
    $slug = strtolower($title); // To Lowercase
    $slug = preg_replace('/[\s_]/', '-', $slug); // Replace spaces,underscores,hyphens
    $slug = preg_replace('/[^\w\-]/', '', $slug); // Remove special characters
    $slug = preg_replace('/\-\-+/', '-', $slug); // Remove consecutive hyphens
    $slug = trim($slug, '-'); // Trim leading and trailing hyphens
    return $slug;
}
