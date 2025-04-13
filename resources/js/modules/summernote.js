export default function setupSummernote({ type }) {
    const $summernote = $('#summernote');
    const $content = $('#content');
    const $imagePath = $('#image_path');

    let imageUploaded = !!$imagePath.val();

    $summernote.summernote({
        height: 300,
        callbacks: {
            onInit: function () {
                const initialContent = $content.val();
                if (initialContent) {
                    $summernote.summernote('code', initialContent);
                }
            },
            onChange: contents => $content.val(contents),
            onImageUpload: files => {
                if (imageUploaded) {
                    toastr.warning('Можно загрузить только одно изображение.');
                    return;
                }
                uploadImage(files[0]);
            },
            onMediaDelete: () => {
                deleteImage();
            }
        }
    });

    function uploadImage(file) {
        const formData = new FormData();
        formData.append('image', file);
        formData.append('type', type);

        axios.post('/editor/images', formData)
            .then(({ data }) => {
                const { image_path, url } = data;

                $summernote.summernote('insertImage', url);
                $imagePath.val(image_path);
                imageUploaded = true;

                toastr.success('Изображение успешно загружено!');
            })
            .catch(error => {
                const message = error.response?.data?.message || 'Неизвестная ошибка загрузки изображения.';
                toastr.error(message, 'Ошибка загрузки');
            });
    }

    function deleteImage() {
        const path = $imagePath.val();
        if (!path) return;

        axios.delete('/editor/images', { data: { image_path: path } })
            .then(() => {
                toastr.info('Изображение удалено.');
            })
            .catch(() => {
                toastr.error('Ошибка при удалении изображения.');
            })
            .finally(() => {
                $imagePath.val(null);
                imageUploaded = false;
            });
    }
}
