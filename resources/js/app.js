import './bootstrap.js'

import setupSortable from "@/modules/sortable.js";
import setupCheckboxes from "@/modules/checkboxes.js";

document.addEventListener('DOMContentLoaded', () => {
    const config = window.pageConfig;

    if (config?.sortableUrl) {
        setupSortable({ url: config.sortableUrl });
    }

    if (config?.checkboxResource) {
        setupCheckboxes({ resource: config.checkboxResource });
    }
});




