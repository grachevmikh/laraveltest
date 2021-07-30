<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSomethingHasSubcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('something_has_subcategory', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $type = DB::connection()->getDoctrineColumn(DB::getTablePrefix().'somethings', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('something_id')->unsigned()->index();
            } else {
                $table->integer('something_id')->unsigned()->index();
            }

            $table->foreign('something_id')->references('id')->on('somethings')->onDelete('cascade');
            $table->bigInteger('subcategory_id')->unsigned()->index();
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->primary(['something_id', 'subcategory_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('something_has_subcategory');
    }
}
