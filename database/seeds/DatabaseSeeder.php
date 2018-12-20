<?php

use ActivismBe\Seeders\DatabaseSeeder as Seeder;
use ActivismBe\Seeders\AclTableSeeder;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        parent::run();
        $this->call(SpecificRoleSeeder::class);
        $this->call(AclTableSeeder::class); // Seeder that handles users and ACL.
    }
}
