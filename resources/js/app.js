import './bootstrap.js'

import setupSortable from "@/modules/sortable.js";
import setupCheckboxes from "@/modules/checkboxes.js";
import setupSummernote from "@/modules/summernote.js";

document.addEventListener('DOMContentLoaded', () => {
    const config = window.pageConfig;

    //Инициализация таблицы DataTables по ID #data-table
    const table = $('#data-table').DataTable({
        ordering: true,              // включаем возможность сортировки по столбцам
        paging: true,                // включаем постраничную навигацию
        order: [],                   // отменяем автоматическую сортировку по первому столбцу
        columnDefs: [
            {targets: 'no-sort', orderable: false} // запрещаем сортировку по столбцу с классом 'no-sort'
        ]
    });

    // Функция инициализации пользовательского интерфейса
    const initUI = () => {
        // Если в конфиге указана sortableUrl — инициализируем drag-and-drop сортировку строк
        if (config?.sortableUrl) {
            setupSortable({url: config.sortableUrl});
        }

        // Если в конфиге указан ресурс для чекбоксов — навешиваем обработчики на чекбоксы
        if (config?.checkboxResource) {
            setupCheckboxes({resource: config.checkboxResource});
        }

        // Повторно применяем красивый Bootstrap Toggle к чекбоксам,
        // так как после перерисовки DataTables оформление может слетать
        $('input[data-toggle="toggle"]').bootstrapToggle();
    };

    // Инициализация Summernote
    if (config?.uploadImageType) {
        setupSummernote({type: config.uploadImageType});
    }

    // Вызываем initUI при первоначальной загрузке страницы
    initUI();

    // Также вызываем initUI каждый раз, когда DataTables "перерисовывает" содержимое таблицы
    // (например, при сортировке, пагинации и т.д.)
    table.on('draw', initUI);
});




