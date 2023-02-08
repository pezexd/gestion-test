<?php

namespace Database\Seeders;

use App\Models\Orientation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrientationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orientations')->delete();
        $route =database_path('/seeders/json/orientations.json');
        $json =file_get_contents($route);
        $data = json_decode($json);

        foreach ($data as $obj) {
           Orientation::create(array(
                'name' => $obj->name,
                "user_id"=>$obj->user_id
            ));
        }

    }
}
