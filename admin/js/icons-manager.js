fn.cb.editIconModalCB = (modal, e) => {
    let $btn = $(e.relatedTarget),
        $modal = $(modal),
        $icon = $btn.parents(".single-icon").first(),
        id = $icon.dataVal("id"),
        info = ICONS[id];

    for (const key in info) {
        let $input = $modal.find(`input[name="${key}"] , textarea[name="${key}"]`);
        $input.val(info[key]);
    }

}



// Copy Icon Content
$(document).on("click", ".copy-icon-content", function () {
    let $icon = $(this).parents(".single-icon").first(),
        id = $icon.dataVal("id"),
        info = ICONS[id];

    copyText(info.content);
});

// Download
$(document).on("click", ".download-icon", function () {
    let $icon = $(this).parents(".single-icon").first(),
        id = $icon.dataVal("id"),
        { content, prefix } = ICONS[id];


    let file = new File(["\ufeff" + content], `${prefix}.svg`, { type: "text/plain:charset=UTF-8" });

    url = window.URL.createObjectURL(file);
    var a = document.createElement("a");
    a.style = "display: none";
    a.href = url;
    a.download = file.name;
    a.click();
    window.URL.revokeObjectURL(url);
});