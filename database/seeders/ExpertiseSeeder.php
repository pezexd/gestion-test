<?php

namespace Database\Seeders;

use App\Models\Expertise;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpertiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('expertises')->delete();
        $route =database_path('/seeders/json/expertises.json');
        $json =file_get_contents($route);
        $data = json_decode($json);

        foreach ($data as $obj) {
           Expertise::create(array(
                'name' => $obj->name,
                "user_id"=>$obj->user_id
            ));
        }
    }
}
