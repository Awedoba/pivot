<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            //users
            [
                'name' => 'View User',
            ],
            [
                'name' => 'Add User',
            ],
            [
                'name' => 'Edit User',
            ],
            [
                'name' => 'Delete User',
            ],
        ];
        foreach ($permissions as $key => $value) {
            \Spatie\Permission\Models\Permission::create($value);
        }
    }
}
