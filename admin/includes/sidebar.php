<div class="sidebar">
    <div class="user-info">
        <div class="user-image-container">
            <img src="../images/users/<?= LOGGED_IN_USER['image']; ?>" alt="user-img" class="user-img">
        </div>
        <div>
            <p class="user-name" style="text-transform: capitalize;"><?= LOGGED_IN_USER['name']; ?></p>
        </div>
    </div>

    <ul class="nav">
        <?php
        foreach (SIDEBAR_OPTIONS_ADMIN as $option) :
            $url = arr_val($option, 'url', '#');
            $childs = arr_val($option, 'childrens', false);
        ?>
            <li class="nav-item <?= $childs ? 'with-sub-menu' : '' ?>">

                <?php if (!$childs) { ?>
                    <a href="<?= $url ?>" class="nav-link">
                        <?= svg_icon($option['icon']) ?>
                        <span class="text"><?= $option['title'] ?></span>
                    </a>

                <?php } else { ?>

                    <a href="<?= $url ?>" class="nav-link">
                        <div class="align-center">
                            <?= svg_icon($option['icon']) ?>
                            <span class="text"><?= $option['title'] ?></span>
                        </div>
                        <?= svg_icon("angle-down")  ?>
                    </a>

                    <ul class="sub-menu">
                        <?php foreach ($childs as $child) : ?>
                            <li class="nav-item">
                                <a href="<?= $child['url'] ?>" class="nav-link justify-content-start">
                                    <?= svg_icon($child['icon']) ?>
                                    <span class="text"><?= $child['title'] ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                <?php } ?>
            </li>



        <?php endforeach; ?>
    </ul>

</div>