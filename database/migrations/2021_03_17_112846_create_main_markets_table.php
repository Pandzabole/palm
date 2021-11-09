<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainMarketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('main_markets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('href');
            $table->string('short');
            $table->integer('position');
            $table->string('cta_type')->default('internal');
            $table->integer('privileges');
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
        Schema::dropIfExists('main_markets');
    }
}
