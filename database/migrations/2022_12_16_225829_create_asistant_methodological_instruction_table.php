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
        Schema::create('assistant_methodological_instruction', function (Blueprint $table) {
            $table->id();
            /* $table->unsignedBigInteger('assistant_id')->nullable();
            $table->unsignedBigInteger('methodological_instruction_id')->nullable();
            $table->primary(['assistant_id', 'methodological_instruction_id'], 'methodological_instruction_assistant_pk'); */

            $table->unsignedBigInteger('assistant_id')->nullable();
            $table->foreign('assistant_id')
                ->references('id')
                ->on('users')->constrained()->onDelete('cascade');

            $table->unsignedBigInteger('m_i_id')->nullable();
            $table->foreign('m_i_id')
                ->references('id')
                ->on('methodological_instructions')->constrained()->onDelete('cascade');

            /* $table->foreignId('assistant_id')->constrained()
                ->onDelete('cascade');
            $table->foreignId('methodological_instruction_id')->constrained()
                ->onDelete('cascade'); */
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
        Schema::dropIfExists('assistant_methodological_instruction');
    }
};
