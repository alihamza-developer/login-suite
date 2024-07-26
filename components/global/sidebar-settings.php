<?php
# Sidebar options for admin
define('SIDEBAR_OPTIONS_ADMIN', [
    [
        'title' => "Dashboard",
        'description' => "View all the statistics and reports",
        'icon' => 'th-large',
        'url' => 'dashboard',
    ],
    [
        'title' => "Users",
        'description' => "View all the users and their details",
        'icon' => 'users',
        'url' => 'users',
    ],
    [
        'title' => "Email Templates",
        'description' => "Manage all the email templates",
        'icon' => 'mail',
        'url' => 'email-templates',
    ],
    [
        'title' => 'Icons Manager',
        'description' => "Manage Site Icons",
        'icon' => 'th-large',
        'url' => 'icons-manager'
    ],
    [
        'title' => "Profile Setting",
        'description' => "Manage your profile settings",
        'icon' => 'settings',
        'url' => _DIR_ . 'user/setting',
    ],
]);

# Sidebar options for user
define('SIDEBAR_OPTIONS_USER', [
    [
        'title' => "Dashboard",
        'description' => "View all the statistics and reports",
        'icon' => 'th-large',
        'url' => 'dashboard',
    ],
    [
        'title' => "Profile Setting",
        'description' => "Manage your profile settings",
        'icon' => 'settings',
        'url' => _DIR_ . 'user/setting',
    ],
]);
