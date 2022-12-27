<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        User::factory(9)->create();
    }
}
