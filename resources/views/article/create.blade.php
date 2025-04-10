<x-app-layout>
    <x-content-header pageTitle="Добавить статью">
        <li class="breadcrumb-item"><a href="/">Главная</a></li>
        <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Статьи</a></li>
        <li class="breadcrumb-item active">Добавить</li>
    </x-content-header>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6 mb-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <form action="{{ route('articles.store') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <x-input-with-label name="title"
                                                    label="Заголовок"
                                                    required
                                                    :messages="$errors->get('title')"/>

                                <x-input-with-label name="slug"
                                                    label="Слаг"
                                                    placeholder="Генерируется автоматически если оставить пустым"
                                                    :messages="$errors->get('slug')"/>

                                <label for="summernote" class="mb-0">Контент</label>
                                <div class="mt-0 mb-1">
                                    <x-input-error :messages="$errors->get('content')"/>
                                    <x-input-error :messages="$errors->get('image_path')"/>
                                </div>
                                <div id="summernote">{!! old('content') !!}</div>
                                <input type="hidden" name="content" id="content">
                                <input type="hidden" name="image_path" id="image_path">

                                <x-select name="category_id"
                                          label="Категория"
                                          :messages="$errors->get('category_id')">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @selected((int)old('category_id') === $category->id)>{{ $category->title }}</option>
                                    @endforeach
                                </x-select>

                                <x-input-switch name="is_active"
                                                label="Активность"
                                                :checked="$errors->has('failedValidation') ? (bool)old('is_active') : true"/>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Добавить</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.form-box -->
                    </div><!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    @push('scripts')
        @push('scripts')
            <script>
                $(document).ready(function () {
                    let imageUploaded = false;

                    $('#summernote').summernote({
                        height: 300,
                        callbacks: {
                            onChange: function(contents) {
                                $('#content').val(contents);
                            },
                            onImageUpload: function(files) {
                                if (!imageUploaded) {
                                    // Разрешаем загрузить только одно изображение
                                    uploadImage(files[0]);
                                } else {
                                    toastr.warning('Можно загрузить только одно изображение.');
                                }
                            },
                            onMediaDelete: function($target) {
                                // Если изображение удалено, сбрасываем флаг
                                imageUploaded = false;
                                toastr.info('Изображение удалено. Можно загрузить новое.');
                            }
                        }
                    });

                    function uploadImage(file) {
                        let data = new FormData();
                        data.append("image", file);

                        axios.post('/articles/upload-image', data)
                            .then(response => {
                                console.log(response.data)
                                const image_path = response.data.image_path;
                                const url = response.data.url;
                                $('#summernote').summernote('insertImage', url);
                                $('#image_path').val(image_path);
                                toastr.success('Изображение успешно загружено!');
                                imageUploaded = true; // Устанавливаем флаг
                            })
                            .catch(error => {
                                console.error(error);
                                const message = error.response?.data?.message || "Неизвестная ошибка загрузки изображения.";
                                toastr.error(message, 'Ошибка загрузки изображения');
                            });
                    }
                });
            </script>
        @endpush


    @endpush
</x-app-layout>
