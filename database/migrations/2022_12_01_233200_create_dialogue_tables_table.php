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
        Schema::create('dialogue_tables', function (Blueprint $table) {
            $table->id();
            $table->date('activity_date');
            $table->time('start_time');
            $table->time('final_hour');
            $table->foreignId('nac_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_review_manager_cultural_id')->nullable();
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->string('target_workday');
            $table->text('theme');
            $table->text('schedule_day');
            $table->text('workday_description');
            $table->text('achievements_difficulties');
            $table->text('alerts');
            $table->string('place_image1');
            $table->string('place_image2');
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
        Schema::dropIfExists('dialogue_tables');
    }
};
