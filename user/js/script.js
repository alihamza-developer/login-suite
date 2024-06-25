const c_location = location.href,
    menu_links = $(".sidebar .nav .nav-link");
let c_link = c_location.split("/").pop(),
    controllers = {};
menu_links.parent().removeClass('active');

Array.from(menu_links).forEach((link) => {
    let href = $(link).attr("href").split("/").pop();
    if (href === c_link) {
        if ($(link).parents(".dropdown").length > 0) {
            $(link).parents(".dropdown").addClass('active');
            $(link).parent().parent().show();
        }
        $(link).parent().addClass("active");
    } else $(link).parent().removeClass('active');
});
