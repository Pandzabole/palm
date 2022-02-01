<?php

use App\Models\ClassCategory;
use App\Models\ClassSubCategory;
use App\Models\Teacher;
use App\Models\ClassLocation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name');
            $table->longText('description');
            $table->longText('description_first');
            $table->longText('description_second');
            $table->string('level');
            $table->unsignedDecimal('price_usd',  8,  2);
            $table->unsignedDecimal('price_eur', 8,  2);
            $table->unsignedDecimal('price_sar', 8,  2);
            $table->unsignedDecimal('price_omr',  8, 2);
            $table->longText('map_location')->nullable();
            $table->boolean('highlighted')->default(false);
            $table->boolean('popular')->default(false);
            $table->boolean('discount')->default(false);
            $table->decimal('discount_percentage')->nullable();
            $table->unsignedInteger('position');
            $table->integer('class_length');
            $table->integer('age_restriction')->nullable();
            $table->string('materials')->nullable();
            $table->foreignIdFor(ClassCategory::class);
            $table->foreignIdFor(ClassSubCategory::class);
            $table->foreignIdFor(Teacher::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
