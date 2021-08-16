<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit orders']);
        Permission::create(['name' => 'delete orders']);
        Permission::create(['name' => 'create orders']);
        Permission::create(['name' => 'read orders']);

        Permission::create(['name' => 'edit payments']);
        Permission::create(['name' => 'delete payments']);
        Permission::create(['name' => 'create payments']);
        Permission::create(['name' => 'read payments']);


        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'staff']);
        $role1->givePermissionTo('edit orders');
        $role1->givePermissionTo('create orders');
        $role1->givePermissionTo('read orders');

        $role1->givePermissionTo('read payments');
        $role1->givePermissionTo('create payments');
        $role1->givePermissionTo('edit payments');

        $role2 = Role::create(['name' => 'manager']);
        $role2->givePermissionTo('edit orders');
        $role2->givePermissionTo('delete orders');
        $role2->givePermissionTo('create orders');
        $role2->givePermissionTo('read orders');

        $role2->givePermissionTo('edit payments');
        $role2->givePermissionTo('delete payments');
        $role2->givePermissionTo('create payments');
        $role2->givePermissionTo('read payments');


        $role3 = Role::create(['name' => 'accountant']);
        $role3->givePermissionTo('edit payments');
        $role3->givePermissionTo('delete payments');
        $role3->givePermissionTo('create payments');
        $role3->givePermissionTo('read payments');



        $role4 = Role::create(['name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Staff',
            'email' => 'staff@container.medialife.uz',
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@container.medialife.uz',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Accountant',
            'email' => 'accountant@container.medialife.uz',
        ]);
        $user->assignRole($role3);

        $user = \App\Models\User::factory()->create([
            'name' => 'Super-Admin',
            'email' => 'superadmin@container.medialife.uz',
        ]);
        $user->assignRole($role4);
    }
}
