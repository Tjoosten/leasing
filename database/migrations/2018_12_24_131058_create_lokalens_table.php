<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateLokalensTable
 */
class CreateLokalensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('lokalens', function (Blueprint $table): void {
            $table->increments('id');
            $table->unsignedInteger('verantwoordelijke')->nullable();
            $table->foreign('verantwoordelijke')->references('id')->on('users')->onDelete('SET NULL');
            $table->string('name'); 
            $table->integer('capacity');
            $table->string('capacity_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('lokalens');
    }
}
