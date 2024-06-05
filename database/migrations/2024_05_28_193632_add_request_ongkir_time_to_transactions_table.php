<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->timestamp('request_ongkir_time')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('request_ongkir_time');
        });
    }
    
};
