<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SpatiePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         *  Reset cached roles and permissions
         */
        app()['cache']->forget('spatie.permission.cache');
        app()['cache']->forget('spatie.role.cache');
        app()['cache']->clear();

        /*
         * Create permissions
         */
        Permission::create(['name' => 'see dashboard']);

        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'read roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'create tenants']);
        Permission::create(['name' => 'read tenants']);
        Permission::create(['name' => 'update tenants']);
        Permission::create(['name' => 'delete tenants']);

        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'read users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        Permission::create(['name' => 'create persons']);
        Permission::create(['name' => 'read persons']);
        Permission::create(['name' => 'update persons']);
        Permission::create(['name' => 'delete persons']);
        Permission::create(['name' => 'assign persons']);


        /**
         * Create roles and assign created permissions.
         */
        $super = Role::create(['name' => 'super']);
        $super->givePermissionTo(Permission::all());

        $admin = Role::create(['name' => 'tenant']);
        $admin->givePermissionTo(
            [
                'see dashboard',

                'create users',
                'read users',
                'update users',
                'delete users',

                'create persons',
                'read persons',
                'update persons',
                'delete persons',
                'assign persons',

            ]
        );

        $user = Role::create(['name' => 'manager']);
        $user->givePermissionTo(
            [
                'see dashboard',
                'read persons',
            ]
        );

        $person = Role::create(['name' => 'customer']);
        $person->givePermissionTo(
            [
                'see dashboard',
            ]
        );

        $noob = Role::create(['name' => 'person']);
        $noob->givePermissionTo(
            [
                'read persons',
            ]
        );

        $viewer = Role::create(['name' => 'viewer']);
    }
}
