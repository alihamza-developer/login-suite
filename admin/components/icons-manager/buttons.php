<div class="buttons">

    <button class="btn btn-sm" data-toggle="modal" data-target="#addCategoryPopup"><?= svg_icon("plus")  ?> Add Category</button>
    <label class="btn btn-sm mr-2">
        <?= svg_icon("import")  ?> Import
        <input type="file" class="d-none jx-req-element" name="file" data-target="icons-manager" data-submit='<?= json_encode([
                                                                                                                    'importIcons' => true,
                                                                                                                ]) ?>' accept=".json">
    </label>

    <button class="btn btn-sm mr-2 jx-req-element" data-target="icons-manager" data-submit='<?= json_encode([
                                                                                                'exportIcons' => true,
                                                                                            ]) ?>'><?= svg_icon("export")  ?> Export</button>
    <button class="btn btn-sm" data-toggle="modal" data-target="#addIconPopup"><?= svg_icon("plus")  ?> Add Icon</button>
    <button class="btn load-icons-to-site jx-req-element svg-icon-btn btn-sm" data-target="icons-manager" data-submit='<?= json_encode([
                                                                                                                            'loadIconsToSite' => true
                                                                                                                        ]) ?>' title="Load Icons to Site"><?= svg_icon("reload")  ?></button>
</div>