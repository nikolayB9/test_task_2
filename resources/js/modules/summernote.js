export default function setupSummernote({ type }) {
    const $summernote = $('#summernote');
    const $content = $('#content');
    const $imagePath = $('#image_path');

    let imageUploaded = !!$imagePath.val();
    let deletingImage = false;
    let lastUploadedUrl = null;

    $summernote.summernote({
        height: 300,
        callbacks: {
            onInit: function () {
                const initialContent = $content.val();
                if (initialContent) {
                    $summernote.summernote('code', initialContent);
                }

                const initialImage = $imagePath.val();
                if (initialImage) {
                    const url = '/storage/' + initialImage;
                    $summernote.summernote('insertImage', url);
                    lastUploadedUrl = url;
                }
            },
            onChange: function (contents) {
                $content.val(contents);

                if (deletingImage) return;

                if (!lastUploadedUrl || imageUploaded) return;

                const dummy = document.createElement('div');
                dummy.innerHTML = contents;
                const imgs = dummy.querySelectorAll('img');

                const imageStillInDOM = Array.from(imgs).some(img => {
                    const src = img.getAttribute('src');
                    return src === lastUploadedUrl;
                });

                if (imageStillInDOM) {
                    toastr.error('Это изображение было удалено. Пожалуйста, загрузите его заново.');
                }
            },
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
                lastUploadedUrl = url;
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

        deletingImage = true;

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
                deletingImage = false;
                // Оставляем lastUploadedUrl — чтобы onChange знал, что это URL удалённого изображения
            });
    }
}
