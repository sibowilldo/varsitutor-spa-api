<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'hod']);
        Role::create(['name' => 'teacher']);
        Role::create(['name' => 'applicant']);

        $permissionsByRole = [
            'hod' => ['approve vacancies', 'reject vacancies'],
            'teacher' => ['edit vacancies', 'delete vacancies', 'publish vacancies', 'unpublish vacancies'],
            'applicant' => ['edit applications', 'delete applications', 'publish applications', 'withdraw applications'],
        ];

        $insertPermissions = fn ($role) => collect($permissionsByRole[$role])
            ->map(fn ($name) => DB::table('permissions')->insertGetId(['name' => $name, 'guard_name' => 'web']))
            ->toArray();

        $permissionIdsByRole = [
            'hod' => $insertPermissions('hod'),
            'teacher' => $insertPermissions('teacher'),
            'applicant' => $insertPermissions('applicant'),
        ];

        foreach ($permissionIdsByRole as $role => $permissionIds) {
            $role = Role::whereName($role)->first();

            DB::table('role_has_permissions')
                ->insert(
                    collect($permissionIds)->map(fn ($id) => [
                        'role_id' => $role->id,
                        'permission_id' => $id,
                    ])->toArray()
                );
        }

        $admin = Role::whereName('admin')->first();
        $admin->givePermissionTo(Permission::all());
    }
}
