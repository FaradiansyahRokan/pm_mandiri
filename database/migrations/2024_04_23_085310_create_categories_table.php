<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('list_size')->enum(['mini', 'big', '1/4kg', '1/2kg', '1kg']);
            $table->string('list_flavour')->enum(['chocolate', 'strawberry', 'vanilla', 'barbeque', 'pedas', 'original']);
            $table->string('list_menu')->enum(['pisang', 'makaroni', 'basreng', 'ususkrispi']);
            $table->softDeletes();
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
        Schema::dropIfExists('categories');
    }
};