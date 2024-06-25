<nav class="navbar">
    <a class="logo page-name" href="dashboard">
        User Dashboard
    </a>
    <div class="menu">
        <div class="dropdown">
            <button class="dropdown-toggle menu-item no-arrow-icon" type="button" data-toggle="dropdown">
                <img src="../images/users/<?= LOGGED_IN_USER['image']; ?>" alt="user-img" class="user-img">
            </button>
            <div class="dropdown-menu">
                <?php if (IS_ADMIN) { ?>
                    <a href="<?= _DIR_ ?>admin/login" class="dropdown-item"><?= svg_icon("user-cog");  ?> <span class="text">Admin Dashboard</span></a>
                <?php } ?>
                <a href="logout" class="dropdown-item"><?= svg_icon("sign-out-alt"); ?> <span class="text">Logout</span></a>
            </div>
        </div>
    </div>
</nav>