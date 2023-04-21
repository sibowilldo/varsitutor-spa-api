<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
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

        Role::create(['name' => RolesEnum::ADMIN->value]);
        Role::create(['name' =>  RolesEnum::HOD->value]);
        Role::create(['name' =>  RolesEnum::TEACHER->value]);
        Role::create(['name' =>  RolesEnum::APPLICANT->value]);

        $permissionsByRole = [
             RolesEnum::HOD->value => ['approve vacancies', 'reject vacancies'],
             RolesEnum::TEACHER->value => ['edit vacancies', 'delete vacancies', 'publish vacancies', 'unpublish vacancies'],
             RolesEnum::APPLICANT->value => ['edit applications', 'delete applications', 'publish applications', 'withdraw applications'],
        ];

        $insertPermissions = fn ($role) => collect($permissionsByRole[$role])
            ->map(fn ($name) => DB::table('permissions')->insertGetId(['name' => $name, 'guard_name' => 'web']))
            ->toArray();

        $permissionIdsByRole = [
             RolesEnum::HOD->value => $insertPermissions( RolesEnum::HOD->value),
             RolesEnum::TEACHER->value => $insertPermissions( RolesEnum::TEACHER->value),
             RolesEnum::APPLICANT->value => $insertPermissions( RolesEnum::APPLICANT->value),
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

        $admin = Role::whereName(RolesEnum::ADMIN->value)->first();
        $admin->givePermissionTo(Permission::all());
    }
}
