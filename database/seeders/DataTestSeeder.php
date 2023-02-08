<?php

namespace Database\Seeders;
use App\Models\Inscriptions\BeneficiaryPec;
use App\Models\Inscriptions\Attendant;
use App\Models\Inscriptions\Beneficiary;
use App\Models\Inscriptions\Pec;
use App\Models\Notification;
use Illuminate\Database\Seeder;

class DataTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Notification::factory(3)->create();
        Beneficiary::factory(4)->create();
        Attendant::factory(1)->create();
        Pec::factory(1)->create();
        BeneficiaryPec::factory(1)->create();

    }
}
