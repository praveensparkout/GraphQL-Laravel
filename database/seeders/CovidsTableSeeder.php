<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Covid;
class CovidsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Covid::create([
            'name' => 'Covid-1',
            'description' => 'Covid Phase 1',
            'peopleAffected' => '10000000',
            'deathCount' => '41000',
            'peopleVaccinated' => '0',
            'is_lockdown' => 'No'
        ]);
        Covid::create([
            'name' => 'Covid-2',
            'description' => 'Covid Phase 2',
            'peopleAffected' => '15000000',
            'deathCount' => '99500',
            'peopleVaccinated' => '115668876',
            'is_lockdown' => 'No'
        ]);

        Covid::create([
            'name' => 'Covid-3',
            'description' => 'Covid Phase 3',
            'peopleAffected' => '150230000',
            'deathCount' => '199500',
            'peopleVaccinated' => '215268876',
            'is_lockdown' => 'Yes'
        ]);
    }
}
