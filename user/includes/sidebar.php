<div class="sidebar">
    <div class="user-info text-center">
        <div class="user-image-container">
            <img src="<?= _DIR_ ?>images/users/<?= LOGGED_IN_USER['image'] ?>" alt="user image" class="user-img">
        </div>
        <p class="user-name"><?= LOGGED_IN_USER['name']; ?></p>
    </div>
    <ul class="nav">

        <?php foreach (SIDEBAR_OPTIONS_USER as $option) : ?>
            <li class="nav-item">
                <a href="<?= $option['url'] ?>" class="nav-link">
                    <?= svg_icon($option['icon']) ?>
                    <span class="text"><?= $option['title'] ?></span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>