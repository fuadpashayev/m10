<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Rauf',
            'surname' => 'Abbaszade',
            'email' => 'rafo.abbas@gmail.com',
            'phone' => '0104110144',
            'fin' => '1234567',
        ]);

        $user->pinCodes()->create([
            'pin_code' => $user->getAttribute('pin_code')
        ]);

         $users = User::factory(10)->create();

         $users->each(function ($user) {
             $user->pinCodes()->create([
                 'pin_code' => $user->getAttribute('pin_code')
             ]);
         });


    }
}
