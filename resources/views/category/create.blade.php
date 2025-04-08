<x-app-layout>
    <x-content-header pageTitle="Добавить категорию">
        <li class="breadcrumb-item"><a href="/">Главная</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Категории</a></li>
        <li class="breadcrumb-item active">Добавить</li>
    </x-content-header>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6 mb-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <form action="{{ route('categories.store') }}" method="post">
                                @csrf

                                <x-input-with-label name="title"
                                                    label="Название"
                                                    required
                                                    :messages="$errors->get('title')"/>

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
