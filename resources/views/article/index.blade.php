<x-app-layout>
    <x-content-header pageTitle="Статьи">
        <li class="breadcrumb-item"><a href="/">Главная</a></li>
        <li class="breadcrumb-item active">Статьи</li>
    </x-content-header>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-3">
                    <a href="{{ route('articles.create') }}" class="btn btn-primary mb-3">Добавить статью</a>

                    @if (session('success'))
                        <x-alert-success :message="session('success')"/>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <table id="data-table" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 30px;" class="no-sort"></th>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Заголовок
                                    </th>
                                    <th>
                                        Слаг
                                    </th>
                                    <th class="no-sort">
                                        Превью
                                    </th>
                                    <th>
                                        Категория
                                    </th>
                                    <th>
                                        Создана
                                    </th>
                                    <th>
                                        Изменена
                                    </th>
                                    <th>
                                        Активность
                                    </th>
                                    <th class="no-sort">
                                        Действия
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="sortable-table">
                                @foreach($articles as $article)
                                    <tr data-id="{{ $article->id }}">
                                        <td class="handle" style="cursor: grab;">
                                            <i class="fas fa-bars"></i>
                                        </td>
                                        <td>{{ $article->id }}</td>
                                        <td>{{ $article->title }}</td>
                                        <td>{{ $article->slug }}</td>
                                        <td>
                                            <img src="{{ $article->image_url }}" alt="preview" style="width: 100px;">
                                        </td>
                                        <td>{{ $article->category->title }}</td>
                                        <td>{{ $article->created_at }}</td>
                                        <td>{{ $article->updated_at }}</td>
                                        <td>
                                            <span class="d-none">{{ $article->is_active }}</span>
                                            <input type="checkbox"
                                                   {{ $article->is_active ? 'checked' : '' }} data-toggle="toggle"
                                                   data-size="xs" data-id="{{ $article->id }}">
                                        </td>
                                        <td>
                                            <a href="{{ route('articles.edit', $article->id) }}"
                                               type="button"
                                               class="btn btn-primary btn-sm mr-2 mb-1"
                                               title="Редактировать">
                                                <i class="far fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

    @push('scripts')
        <script>
            window.pageConfig = {
                sortableUrl: '/articles/update-order',
                checkboxResource: 'articles'
            };
        </script>
    @endpush
</x-app-layout>
