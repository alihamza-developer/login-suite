//append  Variablesi for tinymce
$(document).on("click", ".emailSmmsVar", function (e) {
    e.preventDefault();
    let variableText = $(this).text().replace((/  |\r\n|\n|\r/gm), ''),
        $form = $(this).parents("form").first();
    variableText = ` ${variableText} `;
    if (window.tinymce)
        tinymce.activeEditor.execCommand('mceInsertContent', false, variableText);
});

//Update Template Callback
fn.cb.updateTemplateCb = (form, btn) => {
    let $btn = $(btn.relatedTarget),
        key = $btn.parents('td').first().data('value'),
        title = $btn.parents("td").first().data("title"),
        $form = $(form),
        $target = $form.find(".template-variables .template-var");
    $target.html(" ");

    //Send Ajax Request
    $.ajax({
        url: "controllers/email-templates",
        method: "POST",
        data: {
            getTemplateData: true,
            key: key
        },
        dataType: "json",
        success: function (res) {
            if (res.status == 'success') {
                data = res.data;
                html = "";
                $form.find(".card-header .template-name").text(title);
                if (data) {
                    data.forEach(variable => {
                        key = capitalizeFirstLetter(variable);
                        key = key.replaceAll("_", " ");
                        html += `${key} : <i class="emailSmmsVar cp badge badge-info bg-purple">{{${variable}}}</i><br>`;
                    });
                }
                $target.append(html);
            }
        },
        error: makeError
    });
}