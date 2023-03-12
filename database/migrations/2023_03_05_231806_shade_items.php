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
        Schema::create('shade_item_available', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('shade_id');
            $table->integer('category_id');
            $table->integer('company_id');
            $table->integer('item_id');
            $table->integer('available_quantity');
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
        Schema::dropIfExists('shade_item_available');
        
    }
};
