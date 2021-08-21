<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = config('app_config.roles');
        $permissions = config('app_config.permissions');

        if (!empty($roles))
        {
            echo 'Running Roles Config...';
            foreach($roles as $role){
                Role::create([
                    'name' => $role,
                    'guard_name' => 'web'
                ]);
            }
        }

        if (!empty($permissions))
            foreach($permissions as $permission)
            {
                Permission::create([
                    'name' => $permission,
                    'guard_name' => 'web'
                ]);

            }

        $superRole = Role::find(3);
        if ($superRole)
            $superRole->syncPermissions($permissions);

    }
}
