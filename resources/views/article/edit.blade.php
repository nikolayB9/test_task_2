<x-app-layout>
    <x-content-header pageTitle="Статья '{{ $article->title }}'">
        <li class="breadcrumb-item"><a href="/">Главная</a></li>
        <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Статьи</a></li>
        <li class="breadcrumb-item active">{{ $article->title }}</li>
    </x-content-header>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">

                    @if (session('success'))
                        <x-alert-success :message="session('success')"/>
                    @endif

                    <!-- User -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Редактировать</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('articles.update', $article->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="card-body">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td class="text-bold">ID</td>
                                        <td>{{ $article->id }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Заголовок</td>
                                        <td>
                                            <x-input-with-label name="title"
                                                                :value="old('title') ?? $article->title"
                                                                placeholder="Имя"
                                                                :messages="$errors->get('title')"
                                                                required/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Слаг</td>
                                        <td>
                                            <x-input-with-label name="slug"
                                                                :value="old('slug') ?? $article->slug"
                                                                placeholder="Генерируется автоматически если оставить пустым"
                                                                :messages="$errors->get('slug')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Контент</td>
                                        <td>
                                            <x-textarea name="content"
                                                        :text="old('content') ?? $article->content"
                                                        rows="8"
                                                        required
                                                        :messages="$errors->get('content')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Категория</td>
                                        <td>
                                            <x-select name="category_id"
                                                      :messages="$errors->get('category_id')">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        @selected($category->id === (int)old('category_id', $article->category_id))>{{ $category->title }}</option>
                                                @endforeach
                                            </x-select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Превью</td>
                                        <td>
                                            <img src="{{ $article->getImageUrl() }}"
                                                 alt="preview"
                                                 style="width: 300px;"
                                                 class="mb-3">
                                            <x-input-file name="image"
                                                          help="Допустимый формат: PNG,JPEG,WEBP"
                                                          :messages="$errors->get('image')"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Активность</td>
                                        <td>
                                            <x-input-switch name="is_active"
                                                            :checked="($article->is_active && !$errors->has('failedValidation'))
                                                            || old('is_active') === 'on'"/>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</x-app-layout>
