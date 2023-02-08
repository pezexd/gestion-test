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
        Schema::create('parent_schools', function (Blueprint $table) {
            $table->id('id');
            $table->foreign('monitor_id')
                ->references('id')
                ->on('users');
            $table->string('consecutive')->nullable();
            $table->date('date');
            $table->foreignId('monitor_id');
            $table->time('start_time');
            $table->time('final_time');
            $table->string('place_attention');
            $table->string('contact');
            $table->text('objective');
            $table->text('development');
            $table->text('conclusions');
            $table->text('development_activity_image')->nullable();
            $table->text('evidence_participation_image')->nullable();
            $table->enum('status', ['REC', 'REV', 'ENREV', 'APRO'])->default('ENREV');
            $table->enum('audited', [0, 1])->default(0);
            $table->text('reject_message')->nullable();

            // Relation creator user
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')
                ->references('id')
                ->on('users');
            
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
        Schema::dropIfExists('parent_schools');
    }
};
