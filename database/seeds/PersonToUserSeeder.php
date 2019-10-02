<?php

use Illuminate\Database\Seeder;
use App\Person;
use App\User;

class PersonToUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Create account for each person.
         */
        /*
        $persons = Person::find([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]);
        */
        $persons = Person::all();
        foreach ($persons as $person) {
            $user = new User();
            $user->tenant_id = 1;
            $user->name = $person->first_name.' '.$person->last_name;
            $user->description = $person->first_name.' '.$person->last_name;
            $user->email = $person->email;
            //$user->approved = 1;
            //$user->password = bcrypt('person');
            $user->save();
            //$user->assignRole('person');
            $person->assignRole('person');
            $person->assignRole('customer');
        }

        /*
        $persons = Person::find([16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35]);

        foreach ($persons as $person) {
            $person->assignRole('student');
        }
        */

        $tenant = User::findOrFail(1);
        $tenant->password = bcrypt('tenant');
        $tenant->assignRole('tenant', 'manager', 'customer', 'person');
        $tenant->save();

        $customer = User::findOrFail(2);
        $customer->password = bcrypt('customer');
        $customer->assignRole('customer', 'person');
        $customer->save();

        $manager = User::findOrFail(3);
        $manager->password = bcrypt('manager');
        $manager->assignRole('manager', 'customer', 'person');
        $manager->save();

        $super = User::findOrFail(4);
        $super->password = bcrypt('super');
        $super->assignRole('super', 'tenant', 'manager', 'customer', 'person');
        $super->save();

    }
}
