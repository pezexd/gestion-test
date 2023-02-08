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
        Schema::create('monthly_monitoring_reports', function (Blueprint $table) {
            $table->id();
            $table->string('consecutive')->nullable();
            $table->date('date');
            $table->string('file')->nullable();

            $table->enum('status', ['REC','REV','ENREV','APRO'])->default('ENREV');
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
        Schema::dropIfExists('monthly_monitoring_reports');
    }
};
