<x-app-layout>
    <x-content-header pageTitle="Пользователь '{{ $user->name }}'">
        <li class="breadcrumb-item"><a href="/">Главная</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Пользователи</a></li>
        <li class="breadcrumb-item active">{{ $user->name }}</li>
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
                        <form action="{{ route('users.update', $user->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="card-body">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td class="text-bold">ID</td>
                                        <td>{{ $user->id }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Роль</td>
                                        <td>
                                            @if(auth()->user()->id === $user->id)
                                                {{ \App\Enums\User\RoleEnum::getDescription($user->role) }}
                                            @else
                                                <x-select name="role">
                                                    @foreach(\App\Enums\User\RoleEnum::asSelectArray() as $role)
                                                        <option @selected(($user->role->value === $role['value'] && !old('role'))
                                                                || (int)old('role') === $role['value'])
                                                                value="{{ $role['value'] }}">{{ $role['name'] }}</option>
                                                    @endforeach
                                                </x-select>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Имя</td>
                                        <td>
                                            <x-input-with-label name="name"
                                                                :value="old('name') ?? $user->name"
                                                                placeholder="Имя"
                                                                :messages="$errors->get('name')"
                                                                required/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Email</td>
                                        <td>
                                            <x-input-with-label name="email"
                                                                :value="old('email') ?? $user->email"
                                                                placeholder="Email пользователя"
                                                                :messages="$errors->get('email')"
                                                                required/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Активность</td>
                                        <td>
                                            <x-input-switch name="is_active"
                                                            :checked="($user->is_active && !$errors->has('failedValidation'))
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
