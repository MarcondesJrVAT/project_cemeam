<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\DetailsFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->createRoles();
        $this->createPermissions();
        $this->createUsers();

        $this->attachPermissionsToRoles();
        $this->attachRolesToUsers();

        Department::factory()->count(50)->create();
    }

    private function createRoles(): void
    {
        Role::create(['name' => 'Super Admin', 'slug' => 'super-admin']);
        sleep(1);
        Role::create(['name' => 'Admin', 'slug' => 'admin']);
        sleep(1);
        Role::create(['name' => 'Author', 'slug' => 'author']);
        sleep(1);
        Role::create(['name' => 'User', 'slug' => 'user']);
    }

    private function createPermissions(): void
    {
        Permission::create(['name' => 'Create User', 'slug' => 'create-user']);
        sleep(1);
        Permission::create(['name' => 'View User', 'slug' => 'view-user']);
        sleep(1);
        Permission::create(['name' => 'Edit User', 'slug' => 'edit-user']);
        sleep(1);
        Permission::create(['name' => 'Delete User', 'slug' => 'delete-user']);
        sleep(1);

        Permission::create(['name' => 'Create Role', 'slug' => 'create-role']);
        sleep(1);
        Permission::create(['name' => 'View Role', 'slug' => 'view-role']);
        sleep(1);
        Permission::create(['name' => 'Edit Role', 'slug' => 'edit-role']);
        sleep(1);
        Permission::create(['name' => 'Delete Role', 'slug' => 'delete-role']);
        sleep(1);

        Permission::create(['name' => 'Create Permission', 'slug' => 'create-permission']);
        sleep(1);
        Permission::create(['name' => 'View Permission', 'slug' => 'view-permission']);
        sleep(1);
        Permission::create(['name' => 'Edit Permission', 'slug' => 'edit-permission']);
        sleep(1);
        Permission::create(['name' => 'Delete Permission', 'slug' => 'delete-permission']);
        sleep(1);
    }

    private function createUsers(): void
    {
        $users = [
            ['name' => 'Super', 'email' => 'super@super.com', 'password' => bcrypt('supersuper')],
            ['name' => 'Admin', 'email' => 'admin@admin.com', 'password' => bcrypt('adminadmin')],
            ['name' => 'Author', 'email' => 'author@author.com', 'password' => bcrypt('authorauthor')],
            ['name' => 'User', 'email' => 'user@user.com', 'password' => bcrypt('useruser')],
        ];
        foreach ($users as $userData) {
            $user = User::create($userData);
            $user->details()->create(DetailsFactory::new()->definition());
            sleep(1);
        }
    }

    private function attachPermissionsToRoles(): void
    {
        $roles = ['super-admin', 'admin', 'author', 'user'];
        $permissions = ['create-user', 'view-user', 'edit-user', 'delete-user', 'create-role', 'view-role', 'edit-role', 'delete-role', 'create-permission', 'view-permission', 'edit-permission', 'delete-permission'];

        foreach ($roles as $roleName) {
            $role = Role::where('slug', $roleName)->first();

            foreach ($permissions as $permissionName) {
                $permission = Permission::where('slug', $permissionName)->first();
                $role->permissions()->attach($permission);
            }
        }
    }

    private function attachRolesToUsers(): void
    {
        $users = ['super@super.com', 'admin@admin.com', 'author@author.com', 'user@user.com'];
        $roles = ['super-admin', 'admin', 'author', 'user'];

        foreach ($users as $index => $userEmail) {
            $user = User::where('email', $userEmail)->first();
            $role = Role::where('slug', $roles[$index])->first();
            $user->roles()->attach($role);
        }
    }
}
