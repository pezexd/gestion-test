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
        Schema::create('psychopedagogical_logbook_assistance_monitors', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('psychopedagogical_logbook_id');
            $table->foreignId('monitor_id');
            $table->timestamps();
            $table->foreign('monitor_id')
                ->references('id')
                ->on('users');
            $table->foreign('psychopedagogical_logbook_id','psychologbook_assistance_monitors_id_foreign')
                ->references('id')
                ->on('psychopedagogical_logbooks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('psychopedagogical_logbook_assistance_monitors');
    }
};
