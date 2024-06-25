<div class="popup-window" id="updateEmailTemplate" data-callback="updateTemplateCb">
    <div class="content">
        <div class="card">

            <div class="card-header pull-away">
                <span>Update <b class="template-name"></b> Template</span>
                <span data-dismiss="popup" class="cp"><?= svg_icon("times"); ?></span>
            </div>

            <div class="card-body">
                <form action="email-templates" method="POST" class="ajax_form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <span class="label">Subject</span>
                                <input type="text" class="form-control" name="subject" required data-length='[0-50]'>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <span class="label">Body</span>
                                <div class="tinymce-inline-editor" style="min-height: 200px; overflow: auto" id="tinymceEditor1"></div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="card folding-card p-0">
                                    <div class="card-header pull-away cp">
                                        <p class="template-var-text">Click here to see <b class="type-name">Email</b> variables</p>
                                        <i class="fas fa-angle-down"></i>
                                    </div>
                                    <div class="card-body template-variables">
                                        <div class="template-var"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="hidden" name="key" value="">
                            <input type="hidden" name="updateEmailTemplate" value="true">
                            <button type="submit" class="btn">
                                <?= svg_icon("save")  ?> Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>