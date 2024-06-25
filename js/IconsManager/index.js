fn.cb.exportIconsCB = ($el, res) => {
    let success = handleAlert(res);
    if (!success) return false;
    res = JSON.parse(res);
    ICONS_MANAGER.exportIcons(res.data);
    return false;
}