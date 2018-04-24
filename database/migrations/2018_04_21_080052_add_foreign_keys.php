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
            $table->index('creator_id');
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->foreign('creator_id')->references('id')->on('users');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
        });
        Schema::table('vendors', function (Blueprint $table) {
            $table->index('creator_id');
            $table->foreign('creator_id')->references('id')->on('users');
        });
        Schema::table('types', function (Blueprint $table) {
            $table->index('creator_id');
            $table->foreign('creator_id')->references('id')->on('users');
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
            $table->dropForeign('items_creator_id_foreign');
            $table->dropIndex('items_creator_id_index');
        });
        Schema::table('vendors', function (Blueprint $table) {
            $table->dropForeign('vendors_creator_id_foreign');
            $table->dropIndex('vendors_creator_id_index');
        });
        Schema::table('types', function (Blueprint $table) {
            $table->dropForeign('types_creator_id_foreign');
            $table->dropIndex('types_creator_id_index');
        });
    }
}
