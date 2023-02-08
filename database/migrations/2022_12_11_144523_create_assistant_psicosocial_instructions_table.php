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
        Schema::create('assistant_psicosocial_instructions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('psycho_inst_id')->constrained()
                ->onDelete('cascade')->on('psychosocial_instructions');
            $table->foreignId('assistant_id')->constrained()
                ->onDelete('cascade')->on('assistants');
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
        Schema::dropIfExists('assistant_psicosocial_instructions');
    }
};
