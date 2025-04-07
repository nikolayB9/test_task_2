import Sortable from 'sortablejs';

export default function setupSortable({ url }) {
    const tableBody = document.getElementById('sortable-table');
    if (tableBody) {
        new Sortable(tableBody, {
            handle: '.handle',
            animation: 150,
            onEnd: function () {
                const newOrder = Array.from(tableBody.children).map((row, index) => {
                    return {
                        id: row.dataset.id,
                        order: index + 1
                    };
                });

                axios.put(url, {
                    order: newOrder
                });
            }
        });
    }
}
