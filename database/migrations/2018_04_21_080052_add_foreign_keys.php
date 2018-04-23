<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->index('vendor_id');
            $table->index('type_id');
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign('items_vendor_id_foreign');
            $table->dropIndex('items_vendor_id_index');
            $table->dropForeign('items_type_id_foreign');
            $table->dropIndex('items_type_id_index');
        });
    }
}
