<?php

namespace Database\Seeders;

use App\Enums\User\RoleEnum;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
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
        $numberOfUsers = rand(30, 100);
        $i = 2;

        while ($i <= $numberOfUsers) {
            User::factory()->create([
                'order' => $i,
            ]);
            $i++;
        }
    }
}
