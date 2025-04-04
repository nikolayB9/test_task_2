<?php

namespace App\Enums\User;

use App\Enums\Attributes\Description;
use App\Enums\Traits\GetsAttributes;

enum RoleEnum: int
{
    use GetsAttributes;

    #[Description('Пользователь')]
    case USER = 1;

    #[Description('Админ')]
    case ADMIN = 2;
}
