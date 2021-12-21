<?php

use App\Models\Classe;
use App\Models\Teacher;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->longText('comment');
            $table->foreignIdFor(Classe::class);
            $table->foreignIdFor(Teacher::class);
            $table->string('phone');
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->boolean('read_reservation')->default(false);
            $table->boolean('reply_client')->default(false);
            $table->boolean('is_payed')->default(false);
            $table->decimal('amount', $precision = 8, $scale = 2);
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
        Schema::dropIfExists('reservation_classes');
    }
}
