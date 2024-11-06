<?php

namespace Database\Seeders;

use App\Enums\Role as EnumsRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Artisan::call('optimize:clear');
        // Role::query()->delete();
        // Permission::query()->delete();

        $roles_permissions = collect(EnumsRole::DETAIL)->map(function ($role, $role_name) {
            return [
                'name' => $role_name,
                'guard_name' => 'web',
                'permissions' => $role['permission'],
            ];
        });

        // create permissions
        collect($roles_permissions)->map(function ($role_permission) {
            return $role_permission['permissions'];
        })->flatten()->unique()->map(function ($permission) {
            return Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        });

        // delete permissions that not in the list

        Permission::whereNotIn('name', collect($roles_permissions)->map(function ($role_permission) {
            return $role_permission['permissions'];
        })->flatten()->unique()->toArray())->delete();


        // create roles
        foreach ($roles_permissions as $role_permission) {
            $role = Role::firstOrCreate([
                'name' => $role_permission['name'],
                'guard_name' => $role_permission['guard_name'],
            ]);

            $role->syncPermissions($role_permission['permissions']);
        }

        // delete roles that not in the list
        Role::whereNotIn('name', collect($roles_permissions)->map(function ($role_permission) {
            return $role_permission['name'];
        })->toArray())->delete();

    }
}
