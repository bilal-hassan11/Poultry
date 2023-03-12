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
        Schema::create('sale_medicine', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('med_det_id');
            $table->integer('account_id');
            $table->integer('party_name');
            $table->integer('net_ammount')->nullable();
            $table->integer('sale_ammount')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('commission')->nullable();
            $table->integer('phone_no')->nullable();
            $table->enum('status', ['cash','credit']);
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('sale_medicine');

    }
};
