<?php

use App\Models\ClassCategory;
use App\Models\ClassSubCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassCategoryClassSubCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_category_class_sub_category', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ClassCategory::class)->constrained()->onDelete('cascade');;
            $table->foreignIdFor(ClassSubCategory::class)->constrained()->onDelete('cascade');;
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
        Schema::dropIfExists('class_category_class_sub_category');
    }
}
