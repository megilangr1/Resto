<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
					'id' => 1,
					'name' => 'Admin',
					'guard_name' => 'web'
				]);

				$role = Role::create([
					'id' => 2,
					'name' => 'Pegawai',
					'guard_name' => 'web'
				]);
    }
}
