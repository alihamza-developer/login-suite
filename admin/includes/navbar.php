<nav class="navbar">
    <a class="logo page-name" href="dashboard">
        Admin Dashboard
    </a>
    <div class="menu">
        <div class="dropdown">
            <button class="dropdown-toggle menu-item no-arrow-icon" type="button" data-toggle="dropdown">
                <img src="../images/users/<?= LOGGED_IN_USER['image']; ?>" alt="user-img" class="user-img">
            </button>
            <div class="dropdown-menu">
                <a href="<?= _DIR_ ?>user/dashboard" class="dropdown-item"><?= svg_icon("external-link-alt")  ?><span class="text">Go To Site</span></a>
                <a href="<?= _DIR_ ?>user/logout" class="dropdown-item"><?= svg_icon("logout")  ?> <span class="text">Logout</span></a>
            </div>
        </div>
    </div>
</nav>