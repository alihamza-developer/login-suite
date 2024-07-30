<div class="buttons card-buttons">


    <input type="text" class="form-control live-search focused" data-target=".single-icon" placeholder="Search icon..." data-radius=".card" data-match=".icon-name">

    <label class="btn btn-sm">
        <?= svg_icon("arrow-down")  ?> Import
        <input type="file" class="d-none jx-req-element" name="file" data-target="icons-manager" data-submit='<?= json_encode([
                                                                                                                    'importIcons' => true,
                                                                                                                ]) ?>' accept=".json">
    </label>

    <button class="btn btn-sm jx-req-element" data-target="icons-manager" data-submit='<?= json_encode([
                                                                                            'exportIcons' => true,
                                                                                            "type" => "json"
                                                                                        ]) ?>'><?= svg_icon("export")  ?> Export</button>

    <button class="btn btn-sm jx-req-element" data-target="icons-manager" data-submit='<?= json_encode([
                                                                                            'exportIcons' => true,
                                                                                            "type" => "zip"
                                                                                        ]) ?>'><?= svg_icon("export")  ?> Export ZIP File</button>

    <label class="btn btn-sm">
        <?= svg_icon("plus")  ?> Add icon

        <input type="file" class="d-none jx-req-element" multiple name="file[]" data-target="icons-manager" data-submit='<?= json_encode([
                                                                                                                                'addIcon' => true,
                                                                                                                            ]) ?>' accept=".svg">

    </label>

</div>