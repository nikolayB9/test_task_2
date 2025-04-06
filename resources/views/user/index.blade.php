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
                            <table class="table">
                                <thead>
                                <tr>
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
                                        Дата создания
                                    </th>
                                    <th>
                                        Дата изменения
                                    </th>
                                    <th>
                                        Активность
                                    </th>
                                    <th>
                                        Действия
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ \App\Enums\User\RoleEnum::getDescription($user->role) }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->updated_at }}</td>
                                        <td>
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
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    @push('scripts')
        <script>
            $('input[type="checkbox"]').change(function () {
                const isChecked = $(this).prop('checked');
                const userId = $(this).data('id');

                axios.put(`users/${userId}/toggle-activity`, {
                    activity: isChecked ? 'active' : 'inactive'
                })
            });
        </script>
    @endpush
</x-app-layout>
