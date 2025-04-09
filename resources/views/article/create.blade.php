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
                            <form action="{{ route('articles.store') }}" method="post">
                                @csrf

                                <x-input-with-label name="title"
                                                    label="Заголовок"
                                                    required
                                                    :messages="$errors->get('title')"/>

                                <x-input-with-label name="slug"
                                                    label="Слаг"
                                                    placeholder="Генерируется автоматически если оставить пустым"
                                                    :messages="$errors->get('slug')"/>

                                <x-textarea name="content"
                                            label="Контент"
                                            :text="old('content')"
                                            required
                                            :messages="$errors->get('content')"/>

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
</x-app-layout>
