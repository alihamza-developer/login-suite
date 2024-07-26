<div class="modal fade" id="editIconModal" data-callback="editIconModalCB" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="col-md-12">
                <div class="card p-0">
                    <div class="card-header pull-away">
                        <span>Edit Icon</span>
                        <span data-dismiss="modal" class="cp"><?= svg_icon("times"); ?></span>
                    </div>
                    <div class="card-body">

                        <form action="icons-manager" method="POST" class="js-form own-target w-100">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="label">Name</span>
                                        <input type="text" class="form-control" name="name" placeholder="Type icon name here...">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="label">Prefix</span>
                                        <input type="text" class="form-control" name="prefix" placeholder="Enter Prefix...">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <span class="label">Icon Name</span>
                                        <textarea rows="5" name="content" class="form-control" placeholder="SVG Content here..."></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <input type="hidden" name="id">
                                    <input type="hidden" name="editIcon" value="true">
                                    <button type="submit" class="btn"><?= svg_icon('edit') ?> Save</button>
                                </div>

                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>