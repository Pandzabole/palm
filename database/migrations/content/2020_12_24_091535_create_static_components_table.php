<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaticComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('static_components', function (Blueprint $table) {
            $table->id();
            $table->string('tag')->nullable();
            $table->string('primary_title')->nullable();
            $table->string('secondary_title')->nullable();
            $table->string('sub_title')->nullable();
            $table->text('description')->nullable();
            $table->string('cta')->nullable();
            $table->string('url')->nullable();
            $table->string('cta_type')->default('internal');
            $table->string('slug')->nullable();
            $table->string('type')->default('staticComponent');
            $table->json('config')->nullable();
            $table->unsignedInteger('position')->nullable();
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
        Schema::dropIfExists('static_components');
    }
}
