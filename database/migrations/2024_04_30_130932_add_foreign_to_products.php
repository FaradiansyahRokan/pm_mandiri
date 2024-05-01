<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('id_category_flavour');
            $table->unsignedBigInteger('id_category_menu');
            $table->unsignedBigInteger('id_category_size');

            $table->foreign('id_category_flavour')->references('id')->on('category_flavours');
            $table->foreign('id_category_menu')->references('id')->on('category_menus');
            $table->foreign('id_category_size')->references('id')->on('category_sizes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
