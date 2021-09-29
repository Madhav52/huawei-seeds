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
            'email' => 'info@seednepal.com',
            'password' => bcrypt('SeedsForNepal'),
            'role' => '1',
        ]);
    }
}
