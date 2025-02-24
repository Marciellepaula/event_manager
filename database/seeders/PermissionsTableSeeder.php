<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Constants\Permission as ConstantsPermission;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [];
        $listPermissions = collect(ConstantsPermission::PERMISSIONS)->flatten();

        foreach ($listPermissions as $permission) {
            $permissions[] = [
                'permission' => $permission
            ];
        }

        Permission::query()->insert($permissions);
    }
}
