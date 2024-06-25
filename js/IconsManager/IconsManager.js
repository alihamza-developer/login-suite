class IconsManager {
    constructor() {

    }


    // Export Icons
    exportIcons(data) {
        let { filename, url } = data;
        downloadFile(filename, url); // Download File
    }

    // Import File
    importIcons() {

    }
}

const ICONS_MANAGER = new IconsManager();
