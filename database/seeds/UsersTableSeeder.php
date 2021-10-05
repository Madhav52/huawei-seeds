<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'info@seedsnepal.com',
            'password' => bcrypt('SeedsNepal'),
            'role' => '1',
            'is_verified' => 1
        ]);
    }
}
