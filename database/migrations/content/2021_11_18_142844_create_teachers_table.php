<?php

use App\Models\Gender;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(Gender::class);
            $table->longText('description');
            $table->longText('testimonials_first');
            $table->longText('testimonials_second');
            $table->string('email');
            $table->string('phone');
            $table->string('nationality');
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->integer('age');
            $table->string('url')->nullable();
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
        Schema::dropIfExists('teachers');
    }
}
