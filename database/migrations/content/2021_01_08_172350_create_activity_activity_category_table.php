<?php

use App\Models\Activity;
use App\Models\ActivityCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityActivityCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('activity_activity_category', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(Activity::class);
            $table->foreignIdFor(ActivityCategory::class);
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
        Schema::dropIfExists('activity_activity_category');
    }
}
