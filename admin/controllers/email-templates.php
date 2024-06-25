<?php
define('DIR', '../');
require_once('../includes/db.php');

//Edit Email Template
if (isset($_POST['updateEmailTemplate'])) {
    $key = _POST('key');
    $subject = _POST('subject');
    $body = _POST('body');

    $dbData = [
        'subject' => $subject,
        'body' => $body
    ];

    $update = $db->save("email_templates", $dbData, ['name' => $key]);
    if ($update) {
        echo success("Template update successfully", ['redirect' => '']);
    }
}

//Get Template Data
if (isset($_POST['getTemplateData'])) {
    $key = _POST('key');
    $email = EMAILS[$key];
    $var = [];
    if ($email) {
        if (isset($email['variables'])) {
            $var =  $email['variables'];
        }
    }
    echo success($var);
}
