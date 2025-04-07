<x-app-layout>
    <x-content-header pageTitle="Пользователи">
        <li class="breadcrumb-item"><a href="/">Главная</a></li>
        <li class="breadcrumb-item active">Пользователи</li>
    </x-content-header>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-3">
                    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Добавить пользователя</a>

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
                                        Имя
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Роль
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
                                @foreach($users as $user)
                                    <tr data-id="{{ $user->id }}">
                                        <td class="handle" style="cursor: grab;">
                                            <i class="fas fa-bars"></i>
                                        </td>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="d-none">{{ $user->role }}</span>
                                            @if($user->role === \App\Enums\User\RoleEnum::USER)
                                                <button class="btn btn-primary"
                                                        title="{{ \App\Enums\User\RoleEnum::getDescription($user->role) }}">
                                                    <i class="fas fa-user"></i>
                                                </button>
                                            @elseif($user->role === \App\Enums\User\RoleEnum::ADMIN)
                                                <button class="btn btn-danger"
                                                        title="{{ \App\Enums\User\RoleEnum::getDescription($user->role) }}">
                                                    <i class="fas fa-user-tie"></i>
                                                </button>
                                            @endif
                                        </td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->updated_at }}</td>
                                        <td>
                                            <span class="d-none">{{ $user->is_active }}</span>
                                            <input type="checkbox"
                                                   {{ $user->is_active ? 'checked' : '' }} data-toggle="toggle"
                                                   data-size="xs" data-id="{{ $user->id }}">
                                        </td>
                                        <td>
                                            <a href="{{ route('users.edit', $user->id) }}"
                                               type="button"
                                               class="btn btn-primary btn-sm mr-2 mb-1"
                                               title="Редактировать">
                                                <i class="fas fa-user-edit"></i>
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
                sortableUrl: '/users/update-order',
                checkboxResource: 'users'
            };
        </script>
    @endpush
</x-app-layout>
