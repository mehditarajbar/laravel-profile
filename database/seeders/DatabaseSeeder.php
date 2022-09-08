<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $getConfigRoles=config('permission.default_roles');
        $roleInDatabase = Role::query()->where('name', $getConfigRoles[0]);
        if ($roleInDatabase->count() < 1) {
            foreach ($getConfigRoles as $role){
                Role::query()->create([
                    'name'=>$role,
                ]);
            }
        }
        $getConfigPermissions=config('permission.default_permissions');
        $permissionInDatabase = Role::query()->where('name', $getConfigPermissions[0]);
        if ($permissionInDatabase->count() < 1) {
            foreach ($getConfigPermissions as $permission){
                Role::query()->create([
                    'name'=>$permission,
                ]);
            }
        }
    }
}
