<?php

namespace Database\Seeders;

use App\Models\CulturalRight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CulturalRightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cultural_rights')->delete();
        $route =database_path('/seeders/json/cultural_rights.json');
        $json =file_get_contents($route);
        $data = json_decode($json);

        foreach ($data as $obj) {
           CulturalRight::create(array(
                'name' => $obj->name,
                "user_id"=>$obj->user_id
            ));
        }
    }
}
