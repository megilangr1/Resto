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
        $user = User::create([
					'name' => 'Me Gilang R',
					'username' => 'megilangr',
					'email' => 'megilangr1@gmail.com',
					'password' => bcrypt('nanozero1'),
				]);
				$user->assignRole('Admin');
				
				$user = User::create([
					'name' => 'Pegawai 01',
					'username' => 'pegawai',
					'email' => 'pegawai@gmail.com',
					'password' => bcrypt('pegawai'),
				]);
				$user->assignRole('Pegawai');
    }
}
