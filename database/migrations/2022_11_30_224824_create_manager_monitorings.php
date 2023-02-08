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
        Schema::create('manager_monitorings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('monitor_id');
            $table->foreign('monitor_id')
            ->references('id')
            ->on('users');
            $table->char('activity_date');
            $table->time('start_time');
            $table->time('final_hour');
            // $table->string('tutorial_name');
            $table->text('target_tracking');
            $table->foreignId('nac_id')->constrained()->onDelete('cascade');
            $table->char('cultural_process');
            $table->char('cultural_guidelines');
            $table->char('cultural_communication');
            $table->text('difficulty_cultural_process');
            $table->text('proposal_improvement');
            $table->string('consecutive')->nullable();
            $table->enum('status', ['REC','REV','ENREV','APRO'])->default('ENREV');
            $table->enum('audited', [0,1])->default(0);
            $table->text('reject_message')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manager_monitorings');
    }
};
