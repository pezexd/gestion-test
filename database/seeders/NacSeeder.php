<?php

namespace Database\Seeders;

use App\Models\Nac;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NacSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nacs')->delete();
        $route =database_path('/seeders/json/nacs.json');
        $json =file_get_contents($route);
        $data = json_decode($json);

        foreach ($data as $obj) {
           Nac::create(array(
                'name' => $obj->name,
                "user_id"=>$obj->user_id
            ));
        }
    }
}
