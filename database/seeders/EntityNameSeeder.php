<?php

namespace Database\Seeders;

use App\Models\EntityName;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntityNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entity_names')->delete();
        $route =database_path('/seeders/json/entity_names.json');
        $json =file_get_contents($route);
        $data = json_decode($json);

        foreach ($data as $obj) {
           EntityName::create(array(
                'name' => $obj->name,
                "user_id"=>$obj->user_id
            ));
        }
    }
}
