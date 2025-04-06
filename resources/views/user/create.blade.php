<x-app-layout>
    <x-content-header pageTitle="Добавить пользователя">
        <li class="breadcrumb-item"><a href="/">Главная</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Пользователи</a></li>
        <li class="breadcrumb-item active">Добавить</li>
    </x-content-header>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6 mb-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <form action="{{ route('users.store') }}" method="post">
                                @csrf

                                <x-input-with-icon name="name"
                                                   placeholder="Имя"
                                                   icon="fas fa-user"
                                                   :messages="$errors->get('name')"
                                                   required/>

                                <x-input-with-icon type="email"
                                                   name="email"
                                                   placeholder="Эл.почта"
                                                   icon="fas fa-envelope"
                                                   :messages="$errors->get('email')"
                                                   required/>

                                <x-select name="role">
                                    @foreach(\App\Enums\User\RoleEnum::asSelectArray() as $role)
                                        <option @selected(old('role') === $role['value'])
                                                value="{{ $role['value'] }}">{{ $role['name'] }}</option>
                                    @endforeach
                                </x-select>

                                <x-input-with-icon type="password"
                                                   name="password"
                                                   placeholder="Пароль"
                                                   icon="fas fa-lock"
                                                   :messages="$errors->get('password')"
                                                   required/>

                                <x-input-with-icon type="password"
                                                   name="password_confirmation"
                                                   placeholder="Повторите пароль"
                                                   icon="fas fa-lock"
                                                   :messages="$errors->get('password_confirmation')"
                                                   required/>

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
