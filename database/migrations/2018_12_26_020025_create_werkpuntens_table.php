<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateWerkpuntensTable
 */
class CreateWerkpuntensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('werkpuntens', function (Blueprint $table): void {
            $table->increments('id');
            $table->unsignedInteger('lokalen_id')->nullable();
            $table->unsignedInteger('creator_id')->nullable();
            $table->boolean('is_open')->default(true);
            $table->string('title');
            $table->text('extra_informatie')->nullable();
            $table->timestamps();

            // Foreign keys.
            $table->foreign('lokalen_id')->references('id')->on('lokalens')->onDelete('cascade');
            $table->foreign('creator_id')->references('id')->on('users')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('werkpuntens');
    }
}
