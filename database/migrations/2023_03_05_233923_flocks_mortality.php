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
        Schema::create('flocks_mortality', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('flock_id');
            $table->integer('item_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('flocks_mortality');
        
    }
};
