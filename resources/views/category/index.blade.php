<x-app-layout>
    <x-content-header pageTitle="Категории">
        <li class="breadcrumb-item"><a href="/">Главная</a></li>
        <li class="breadcrumb-item active">Категории</li>
    </x-content-header>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-3">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Добавить категорию</a>

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
                                        Название
                                    </th>
                                    <th>
                                        Создан
                                    </th>
                                    <th>
                                        Изменен
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
                                @foreach($categories as $category)
                                    <tr data-id="{{ $category->id }}">
                                        <td class="handle" style="cursor: grab;">
                                            <i class="fas fa-bars"></i>
                                        </td>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->title }}</td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>{{ $category->updated_at }}</td>
                                        <td>
                                            <span class="d-none">{{ $category->is_active }}</span>
                                            <input type="checkbox"
                                                   {{ $category->is_active ? 'checked' : '' }} data-toggle="toggle"
                                                   data-size="xs" data-id="{{ $category->id }}">
                                        </td>
                                        <td>
                                            <a href="{{ route('categories.edit', $category->id) }}"
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
                sortableUrl: '/categories/update-order',
                checkboxResource: 'categories'
            };
        </script>
    @endpush
</x-app-layout>
