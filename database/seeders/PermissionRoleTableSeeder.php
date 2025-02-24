<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Constants\PermissionRolesConstants;
use App\Models\Role;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // SuperAdmin
        $role = Role::find(1);
        $Permissions = collect(PermissionRolesConstants::SUPERADM);
        foreach ($Permissions->flatten() as $permission) {
            $role->givePermission($permission);
        }

        // Admin
        $role = Role::find(2);
        $Permissions = collect(PermissionRolesConstants::ADMIN);
        foreach ($Permissions->flatten() as $permission) {
            $role->givePermission($permission);
        }
        // participante
        $role = Role::find(3);
        $Permissions = collect(PermissionRolesConstants::Participante);
        foreach ($Permissions->flatten() as $permission) {
            $role->givePermission($permission);
        }
    }
}
