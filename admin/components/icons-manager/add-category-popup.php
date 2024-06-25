<div class="modal fade" id="addCategoryPopup" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" nc-style="bg-t">
            <div class="col-md-12">
                <div class="card p-0">
                    <div class="card-header pull-away">
                        <span>Add Category</span>
                        <span data-dismiss="modal" class="cp"><?= svg_icon("times"); ?></span>
                    </div>
                    <div class="card-body">

                        <form action="icons-manager" method="POST" class="js-form own-target dismiss-modal" data-reset="true">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <span class="label">Name:</span>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <input type="hidden" name="saveCategory" value="true">
                                    <button type="submit" class="btn"><?= svg_icon("save") ?> save</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>