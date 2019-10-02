<?php

use Illuminate\Database\Seeder;

class PersonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Create two custom persons
         */
        DB::table('persons')->insert(
            [
                [
                    'tenant_id' => 1,
                    'salutation' => 'mr',
                    'first_name' => 'Nermin',
                    'last_name' => 'Elkasovic',
                    'title' => 'Founder',
                    'company_name' => 'Firma AG',
                    'phone' => '+41 78 955 65 65',
                    'mobile' => '+41 78 955 95 95',
                    'fax' => '+41 71 788 98 98',
                    'email' => 'client@smmlight.ch',
                    'approved' => 1,
                    'website' => 'https://url.to',
                ],
                [
                    'tenant_id' => 1,
                    'salutation' => 'mr',
                    'first_name' => 'Lehrperson',
                    'last_name' => 'Technik',
                    'title' => 'Senior Manager',
                    'company_name' => 'ZbW',
                    'phone' => '+41 78 955 65 65',
                    'mobile' => '+41 78 955 95 95',
                    'fax' => '+41 71 788 98 98',
                    'email' => 'teacher@smmlight.ch',
                    'approved' => 1,
                    'website' => 'https://url.to',
                ],
                [
                    'tenant_id' => 1,
                    'salutation' => 'mr',
                    'first_name' => 'Manager',
                    'last_name' => 'Chief',
                    'title' => 'Senior Manager',
                    'company_name' => 'ZbW',
                    'phone' => '+41 78 955 65 65',
                    'mobile' => '+41 78 955 95 95',
                    'fax' => '+41 71 788 98 98',
                    'email' => 'manager@smmlight.ch',
                    'approved' => 1,
                    'website' => 'https://url.to',
                ],
                [
                    'tenant_id' => 1,
                    'salutation' => 'mr',
                    'first_name' => 'Super',
                    'last_name' => 'Admin',
                    'title' => 'Junior Manager',
                    'company_name' => 'Own Boss',
                    'phone' => '+41 78 955 65 65',
                    'mobile' => '+41 78 955 95 95',
                    'fax' => '+41 71 788 98 98',
                    'email' => 'super@smmlight.ch',
                    'approved' => 1,
                    'website' => 'https://url.to',
                ],
            ]
        );

        /**
         * Create some other persons.
         */
        $persons = factory(App\Person::class, 200)->create();
        foreach ($persons as $person) {
            $person->assignRole('customer');
        }

    }
}
