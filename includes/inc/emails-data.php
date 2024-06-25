<?php
$EMAILS_ = [
    'forgotEmail' => [
        'title' => 'Forgot Password',
        'variables' => array_merge(['reset_password_url', 'to']),
    ],
    'verifyEmail' => [
        'title' => 'Verify Email',
        'variables' => array_merge(['verify_email_url', 'to']),
    ],
    'contactEmail' => [
        'title' => 'Contact Email',
        'variables' => array_merge(['name', 'email', 'subject', 'message']),
        'is_non_user_email' => true
    ],
    'assignStore' => [
        'title' => 'Assign Store',
        'variables' => array_merge(['store_name', 'store_url', 'contact_page_link']),
    ],
];

$common_var = ['site_url', 'site_name', 'login_url'];
foreach ($EMAILS_ as $key => $email) {
    $vars = $email['variables'];
    $is_non_user_email = arr_val($email, 'is_non_user_email', false);
    $common_var_ = $common_var;
    if (!$is_non_user_email) {
        array_push($common_var_, 'user_firstname', 'user_lastname', 'user_name', 'user_email');
    }
    $EMAILS_[$key]['variables'] = array_merge($vars, $common_var_);
}

define('EMAILS', $EMAILS_);
unset($EMAILS_);
