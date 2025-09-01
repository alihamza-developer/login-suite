<?php
$page_name = "404";

$CSS_FILES_ = ['404.css'];
include_once "includes/head.php";
?>
<section class="page_404">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="col-sm-10 offset-sm-1  text-center">
                    <div class="four_zero_four_bg">
                        <h1 class="text-center ">404</h1>
                    </div>

                    <div class="contant_box_404">
                        <h3 class="h2">
                            Look like you're lost
                        </h3>

                        <p> The page you are looking for might havbe been moved, renamed or might never existed.</p>

                        <a href="<?= SITE_URL ?>" class="link_404">Go to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once("includes/foot.php") ?>