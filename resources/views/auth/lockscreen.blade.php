<x-guest-layout>
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            AdminPanel
        </div>

        <!-- /.lockscreen-item -->
        <div class="help-block text-center mb-2">
            Доступ только для администраторов
        </div>
        <div class="text-center">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link bg-transparent border-0 hover text-primary">
                    Выйти из текущего профиля и авторизоваться как администратор <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>

    </div>
</x-guest-layout>


