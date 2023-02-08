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
        Schema::create('psychopedagogical_logbooks', function (Blueprint $table) {
            $table->id('id');
            $table->foreign('monitor_id')
                ->references('id')
                ->on('users');

            $table->foreign('nac_id')
                ->references('id')
                ->on('nacs');

            $table->string('consecutive')->nullable();
            $table->date('date');
            $table->foreignId('nac_id');
            $table->time('start_time');
            $table->time('final_time');
            $table->string('person_served_name', 255);
            $table->foreignId('monitor_id');
            $table->text('objective');
            $table->text('development');
            $table->text('referrals');
            $table->text('conclusions_reflections_commitments');
            $table->text('alert_reporting_tracking');
            $table->text('development_activity_image')->nullable();
            $table->text('evidence_participation_image')->nullable();
            $table->enum('audited', [0, 1])->default(0);
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
        Schema::dropIfExists('psychopedagogical_logbooks');
    }
};
