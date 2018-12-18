<?php

use ActivismBe\Seeders\DatabaseSeeder as Seeder;
use ActivismBe\Seeders\AclTableSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        parent::run();
        $this->call(AclTableSeeder::class); // Seeder that handles users and ACL.
    }
}
