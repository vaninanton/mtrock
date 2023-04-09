<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Tony V',
            'email' => 'vaninanton@gmail.com',
            'password' => '$2y$10$JHWdWDKkXH3YxKA4Nnd7DuQAGf6z4S04W2V.C25EW0ESPO5eR5e36',
        ]);
        User::factory()->create([
            'name' => 'Сережа Волков',
            'email' => 'osaaka@yandex.ru',
            'password' => '$2y$10$wn6VjZdeNsGoARn8u8ULBeyPThu4I2QhnGpHINSdqG.hHz3Oiw3oS',
        ]);
    }
}
