<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\{DB, Schema};
use Illuminate\Database\Eloquent\Model;

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
        DB::connection()->disableQueryLog();
        Model::unguard();
        
        if ($this->canResetDatabase()) {
            $this->truncateAll(); // Method for truncating all the database tables.
            $this->command->warn('Al de database tabellen zijn gereset naar lege tabellen!');
        }

        // Start met het lopen van de database seeds in de applicatie. 
        $this->call(AclTableSeeder::class);
    }

    /**
     * Function for het check dat de tabellen een truncate kunnen ontvangen en deze is uitgevoerd. 
     * 
     * @return bool
     */
    protected function canResetDatabase(): bool 
    {
        return app()->isLocal() 
            && $this->command->confirm('Wenst u alle database tabellen te legen, voor het verzadigen van de database?');
    }

    /**
     * Function voor het legen van alle database tabellen. Behalve de migrations tabel. 
     * Die nodig is om te bepalen welke mgratie is doorgevoerd en welke niet? 
     * 
     * @return void
     */
    public function truncateAll(): void 
    {
        Schema::disableForeignKeyConstraints();

        collect(DB::select("SHOW FULL TABLES WHERE Table_Type = 'BASE TABLE'")) 
            ->map(function ($tableProperties) {
                return get_object_vars($tableProperties)[key($tableProperties)];
            })
            ->reject(function (string $tableName) {
                return $tableName === 'migrations';
            })
            ->each(function (string $tableName) {
                DB::table($tableName)->truncate();
            });

        Schema::enableForeignKeyConstraints();
    }
}
