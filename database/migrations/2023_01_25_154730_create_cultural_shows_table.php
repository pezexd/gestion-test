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
        Schema::create('cultural_shows', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('ambassador_id')->nullable();
            $table->foreign('ambassador_id')
                ->references('id')
                ->on('users')->constrained()->onDelete('cascade');

            $table->unsignedBigInteger('leader_ambassador_id')->nullable();
            $table->foreign('leader_ambassador_id')
                ->references('id')
                ->on('users')->constrained()->onDelete('cascade');

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
        Schema::dropIfExists('cultural_shows');
    }
};
