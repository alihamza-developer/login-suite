<?php
assets_file([
    'Libraries/font-awesome.min.css',
    'Libraries/bootstrap.min.css',
    'custom.css',
], 'css', _DIR_ . "css");
?>
<?php $CSS_FILES_ = isset($CSS_FILES_) ? $CSS_FILES_ : []; ?>