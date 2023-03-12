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
        Schema::create('flocks_item_consume', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('flock_id');
            $table->integer('category_id');
            $table->integer('company_id');
            $table->integer('item_id');
            $table->integer('added_quantity');
            $table->enum('status', ['available','not_available']);
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
        Schema::dropIfExists('flocks_item_consume');
    }
};
