<?php

use Illuminate\Database\Seeder;
use Silber\Bouncer\Database\HasRolesAndAbilities;

use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * Superadmin
         */
        /*
        $superadmin = new User();
        $superadmin->client_id = 1;
        $superadmin->description = 'Administrator';
        $superadmin->email = 'elkas@gmx.net';
        $superadmin->password = bcrypt('nermin');
        $superadmin->locale = 'de';
        $superadmin->save();
        $superadmin->assignRole('admin');
        $superadmin->assignRole('user');
        */

        /**
         * Admin 
         */
        /*
        $admin = new User();
        $admin->client_id = 1;
        $admin->description = 'Administrator';
        $admin->email = 'admin@drehbu.ch';
        $admin->password = bcrypt('admin');
        $admin->locale = 'de';
        $admin->save();
        $admin->assignRole('admin');
        $admin->assignRole('user');
        */
        
        /**
         * User
         */
        /*
        $user = new User();
        $user->client_id = 1;
        $user->description = 'Test User';
        $user->email = 'user@drehbu.ch';
        $user->password = bcrypt('user');
        $user->locale = 'de';
        $user->save();
        $user->assignRole('user');
        */

        
        /** 
         * Random user accounts 
         */
        //$users = factory(App\User::class, 10)->create();        
    }
}

