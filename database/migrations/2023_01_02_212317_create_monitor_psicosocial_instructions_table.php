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
        Schema::create('monitor_psicosocial_instructions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('monitor_id')->nullable();
            $table->foreign('monitor_id')
                ->references('id')
                ->on('users')->constrained()->onDelete('cascade');

            $table->foreignId('psycho_inst_id')->references('id')->constrained()->onDelete('cascade')->on('psychosocial_instructions');

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
        Schema::dropIfExists('monitor_psicosocial_instructions');
    }
};
