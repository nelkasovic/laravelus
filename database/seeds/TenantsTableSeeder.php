<?php

use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenants = factory(App\Tenant::class, 40)->create();

        foreach ($tenants as $tenant) {
            $settings = $tenant->settings;

            foreach ($settings as $option) {
                foreach ($option as $key => $value) {
                    $tenant->setMeta($key, $value);
                }
            }
        }
    }
}
