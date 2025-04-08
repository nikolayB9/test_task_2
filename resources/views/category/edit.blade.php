<x-app-layout>
    <x-content-header pageTitle="Категория '{{ $category->title }}'">
        <li class="breadcrumb-item"><a href="/">Главная</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Категории</a></li>
        <li class="breadcrumb-item active">{{ $category->title }}</li>
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
                        <form action="{{ route('categories.update', $category->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="card-body">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td class="text-bold">ID</td>
                                        <td>{{ $category->id }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Название</td>
                                        <td>
                                            <x-input-with-label name="title"
                                                                :value="old('title') ?? $category->title"
                                                                placeholder="Имя"
                                                                :messages="$errors->get('title')"
                                                                required/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Активность</td>
                                        <td>
                                            <x-input-switch name="is_active"
                                                            :checked="($category->is_active && !$errors->has('failedValidation'))
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
