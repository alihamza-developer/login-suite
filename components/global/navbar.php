<nav class="navbar full-width">
    <a class="logo page-name" href="#"><?= SITE_NAME ?></a>
    <div class="menu">
        <?php
        if (!LOGGED_IN_USER) {
        ?>
            <a href="login" class="btn mr-2">Login</a>
            <a href="register" class="btn">Register</a>
        <?php
        } else {
        ?>
            <div class="dropdown">
                <button class="dropdown-toggle menu-item no-arrow-icon" type="button" data-toggle="dropdown">
                    <img src="<?= url('images/users', LOGGED_IN_USER['image']) ?>" alt="user-img" class="user-img">
                </button>
                <div class="dropdown-menu">
                    <?php if (IS_ADMIN) { ?>
                        <a href="<?= _DIR_ ?>admin/login" class="dropdown-item"><?= svg_icon("user-cog");  ?> <span class="text">Admin Dashboard</span></a>
                    <?php } ?>
                    <a href="logout" class="dropdown-item"><?= svg_icon("logout"); ?> <span class="text">Logout</span></a>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</nav>