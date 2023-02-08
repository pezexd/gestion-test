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
        Schema::create('psychosocial_instructions', function (Blueprint $table) {
            $table->id();
            $table->string('consecutive')->unique();
            $table->date('activity_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('final_hour')->nullable();
            $table->foreignId('nac_id')->constrained()->onDelete('cascade');
            $table->text('objective_day');
            $table->text('themes_day');
            $table->string('development_activity_image')->nullable();
            $table->string('evidence_participation_image')->nullable();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['REC','REV','ENREV','APRO'])->default('ENREV');
            $table->enum('audited', [0,1])->default(0);
            $table->text('reject_message')->nullable();
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
        Schema::dropIfExists('psychosocial_instructions');
    }
};
