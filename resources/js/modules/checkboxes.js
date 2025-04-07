import 'bootstrap4-toggle/js/bootstrap4-toggle.min';

export default function setupCheckboxes({ resource }) {
    $('input[type="checkbox"]').change(function () {
        const isChecked = $(this).prop('checked');
        const id = $(this).data('id');

        axios.put(`/${resource}/${id}/toggle-activity`, {
            activity: isChecked ? 'active' : 'inactive'
        })
    });
}
