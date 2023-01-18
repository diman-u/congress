<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

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
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'admin']);
        $role1->givePermissionTo('publish articles');
        $role1->givePermissionTo('unpublish articles');

        $role2 = Role::create(['name' => 'manager']);
        $role2->givePermissionTo('edit articles');
        $role2->givePermissionTo('delete articles');

        $role3 = Role::create(['name' => 'users']);
        $role4 = Role::create(['name' => 'expert']);

        User::find(1)->assignRole($role1);
        User::find(2)->assignRole($role2);
        User::find(3)->assignRole($role3);
        User::find(4)->assignRole($role4);

        //$user->assignRole($role1);


        //$user->assignRole($role3);
    }
}
