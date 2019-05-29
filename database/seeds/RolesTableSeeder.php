<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Super Admin',
            ],
            [
                'name' => 'Administrator',
            ],
            [
                'name' => 'Instructor',
            ],
            [
                'name' => 'Student',
            ]
        ];

        foreach ($roles as $key => $value) {
            if ($value['name']=="Super Admin")
            {
                $permissions = \Spatie\Permission\Models\Permission::all();
                $role = \Spatie\Permission\Models\Role::create($value);
                $role->syncPermissions($permissions->pluck('name'));
            }else{
                \Spatie\Permission\Models\Role::create($value);
            }
        }


    }
}
