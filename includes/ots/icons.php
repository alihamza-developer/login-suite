<?php
define('DIR', '../../');
$iconsPath = DIR . 'images/icons';
$iconFiles = glob($iconsPath . '/*.svg');
$iconsArray = [];

foreach ($iconFiles as $file) {
    $name = basename($file, '.svg');
    $content = file_get_contents($file);
    $iconsArray[$name] = $content;
}
$iconsArray = var_export($iconsArray, true);
$iconsPHP = "<?php\n\$SITE_ICONS = $iconsArray;";

file_put_contents(DIR . 'includes/svg-icons.php', $iconsPHP);
