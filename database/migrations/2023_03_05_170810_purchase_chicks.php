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
        Schema::create('purchase_chick', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('company_id');
            $table->integer('item_id');
            $table->integer('account_id');
            $table->integer('rate')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('net_ammount')->nullable();
            $table->enum('status', ['available','not_available']);
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
        Schema::dropIfExists('purchase_chick');
    }
};
