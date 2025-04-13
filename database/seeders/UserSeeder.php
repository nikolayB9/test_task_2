<?php

namespace Database\Seeders;

use App\Enums\User\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    private int $userCount = 30;

    public function run(): void
    {
        $this->createAdmin();
        $this->createUsers();
    }

    private function createAdmin(): void
    {
        User::factory()->create([
            'name' => 'Администратор',
            'email' => 'admin@mail.ru',
            'role' => RoleEnum::ADMIN,
            'is_active' => true,
            'order' => 1,
        ]);
    }

    private function createUsers(): void
    {
        for ($i = 2; $i <= $this->userCount; $i++) {
            User::factory()->create([
                'order' => $i,
            ]);
        }
    }
}
