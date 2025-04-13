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
                <div class="col-md-10 mb-3">
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
                                <div id="summernote"></div>
                                <input type="hidden" name="content" id="content" value="{{ old('content', '') }}">
                                <input type="hidden" name="image_path" id="image_path" value="{{ old('image_path', '') }}">

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
        <script>
            window.pageConfig = {
                uploadImageType: 'articles',
            };
        </script>
    @endpush
</x-app-layout>
