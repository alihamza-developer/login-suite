<div class="modal fade" id="addIconPopup" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="col-md-12">
                <div class="card p-0">
                    <div class="card-header pull-away">
                        <span>Add Icon</span>
                        <span data-dismiss="modal" class="cp"><?= svg_icon("times"); ?></span>
                    </div>
                    <div class="card-body">
                        <form action="icons-manager" method="POST" class="js-form own-target w-100">

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="label">Category:</span>
                                        <select name="category_id" class="form-control">
                                            <option selected disabled>--Select--</option>
                                            <?php
                                            $categories = $icons_manager->_category->getAll([
                                                'type' => $icons_manager->category_type,
                                                'columns' => 'uid,name'
                                            ]);
                                            // print_r($categories);
                                            // exit;

                                            foreach ($categories as $category) {
                                                $id = $category['uid'];
                                                $name = $category['name'];
                                            ?>
                                                <option value="<?= $id ?>"><?= $name ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="label">Select Icons</span>
                                        <input type="file" name="file[]" multiple accept=".svg">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <input type="hidden" name="addIcon" value="true">
                                    <button class="btn"><?= svg_icon("save")  ?> save</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>