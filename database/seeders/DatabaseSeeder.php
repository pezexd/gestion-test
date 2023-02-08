<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ModuleSeeder::class,
            ModuleItemSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            RoleUserSeeder::class,
            CulturalRightSeeder::class,
            EntityNameSeeder::class,
            ExpertiseSeeder::class,
            NacSeeder::class,
            NeighborhoodSeeder::class,
            OrientationSeeder::class,
            PedagogicalSeeder::class,
            GroupSeeder::class,
            DataTestSeeder::class,
            PollDesertion::class,
            PermissionRoleSeeder::class,
            ProfileSeeder::class,
            PecSeeder::class
        ]);
    }
}
