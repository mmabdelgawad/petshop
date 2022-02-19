<?php

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
        User::factory(1)->create([
            'first_name' => 'petshop',
            'last_name' => 'buckhill',
            'email' => 'petshop@buckhill.com',
            'is_admin' => 0,
            'email_verified_at' => now(),
            'last_login_at' => null,
            'is_marketing' => 0,
        ]);
        User::factory(9)->create();
    }
}
