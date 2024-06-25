<ul class="nav nav-tabs">
    <?php
    $categories = $icons_manager->_category->getAll([
        'type' => $icons_manager->category_type
    ]);

    $count = 1;
    foreach ($categories as $category) {
        $name = arr_val($category, 'name');
        $slug = arr_val($category, 'slug');
        $is_active = $count == 1 ? 'active show' : '';
    ?>

        <li class="nav-item">
            <button class="nav-link <?= $is_active ?>" data-toggle="tab" data-target="#<?= $slug ?>-icons-panel"><?= $name ?></button>
        </li>
    <?php
        $count++;
    }
    ?>
</ul>

<div class="tab-content">

    <?php
    $icons_data = $icons_manager->get_icons_data();

    $count_ = 1;
    foreach ($icons_data as $slug => $item) {
        $is_active = $count_ == 1 ? 'active show fade' : '';

    ?>
        <div class="tab-pane fade <?= $is_active ?>" id="<?= $slug ?>-icons-panel">RET</div>

    <?php
        $count_++;
    } ?>


</div>