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
        Schema::create('flock_detail', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->integer('shade_id')->nullable();
            $table->integer('flock_id')->nullable();
            $table->integer('no_of_chicks_Added')->nullable();
            $table->integer('feed_begs_consume')->nullable();
            $table->integer('Available_murghi')->nullable();
            $table->integer('total_mortality')->nullable();
            $table->integer('total_begs_cost')->nullable();
            $table->integer('total_chicks_cost')->nullable();
            $table->integer('total_sale_cost')->nullable();
            $table->integer('total_medicine_cost')->nullable();
            $table->integer('total_wood_cost')->nullable();
            $table->integer('other_expenses')->nullable();
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
        Schema::dropIfExists('flock_detail');
    }
};
