<?php

namespace Database\Seeders;

use App\Models\Neighborhood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NeighborhoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('neighborhoods')->delete();
        $route =database_path('/seeders/json/neighborhoods.json');
        $json =file_get_contents($route);
        $data = json_decode($json);

        foreach ($data as $obj) {
           Neighborhood::create(array(
                'name' => $obj->name,
                "user_id"=>$obj->user_id
            ));
        }
    }
}
