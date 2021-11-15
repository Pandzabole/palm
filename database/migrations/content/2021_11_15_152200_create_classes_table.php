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
            $table->string('name');
            $table->longText('description');
            $table->decimal('price', $precision = 8, $scale = 2);
            $table->longText('map_location')->nullable();
            $table->foreignId(ClassLocation::class);
            $table->foreignId(ClassCategory::class);
            $table->foreignId(ClassSubCategory::class);
            $table->foreignId(Teacher::class);
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
