<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //first go and add item and then after store redirect to the add images for this item 
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('parcode');
            $table->integer('category_id')->unsigned();
            $table->string('name');
            $table->integer('price');
            $table->integer('sale');
            $table->string('mainPhoto');
            $table->integer('price_after_sale');
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
        Schema::dropIfExists('items');
    }
}
