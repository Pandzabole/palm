<?php

use App\Models\Classe;
use App\Models\ClassLocation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassLocationClasseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_location_classe', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Classe::class);
            $table->foreignIdFor(ClassLocation::class);
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
        Schema::dropIfExists('class_location_classe');
    }
}
