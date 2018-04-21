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
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_name');
            $table->integer('vendor_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->string('serial_number');
            $table->decimal('price',11,2);
            $table->decimal('weight',11,2);
            $table->string('color');
            $table->date('release_date');
            $table->string('photo');
            $table->text('tags');
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
