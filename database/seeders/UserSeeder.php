<?php

namespace Database\Seeders;

use App\Models\Dentist;
use App\Models\Patient;
use App\Models\Receptionist;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->for(Dentist::factory(), 'profilable')->create();
        User::factory()->for(Dentist::factory(), 'profilable')->create();
        User::factory()->for(Dentist::factory(), 'profilable')->create();


        User::factory()->for(Receptionist::factory(), 'profilable')->create();
        User::factory()->for(Receptionist::factory(), 'profilable')->create();

        User::factory()->for(Patient::factory(), 'profilable')->create();
        User::factory()->for(Patient::factory(), 'profilable')->create();
        User::factory()->for(Patient::factory(), 'profilable')->create();
        User::factory()->for(Patient::factory(), 'profilable')->create();
        User::factory()->for(Patient::factory(), 'profilable')->create();
        User::factory()->for(Patient::factory(), 'profilable')->create();
    }
}
