import './bootstrap.js'
import 'bootstrap4-toggle/js/bootstrap4-toggle.min';
import Sortable from 'sortablejs';

document.addEventListener('DOMContentLoaded', () => {
    const tableBody = document.getElementById('sortable-table');
    if (tableBody) {
        new Sortable(tableBody, {
            animation: 150,
            onEnd: function (evt)  {
                const newOrder = Array.from(tableBody.children).map((row, index) => {
                    return {
                        id: row.dataset.id,
                        order: index + 1
                    }
                });

                axios.put('/users/update-order', {
                    order: newOrder
                })
            }
        });
    }
});




