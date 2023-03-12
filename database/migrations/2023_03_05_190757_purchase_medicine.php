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
        Schema::create('purchase_medicine', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('account_id');
            $table->integer('category_id');
            $table->integer('company_id');
            $table->integer('item_id');
            $table->integer('quantity');
            $table->integer('rate');
            $table->integer('net_ammount')->nullable();
            $table->integer('purchase_ammount')->nullable();
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
        Schema::dropIfExists('purchase_medicine');

    }
};
