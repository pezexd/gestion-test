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
        Schema::create('parent_school_assistance_monitors', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('parent_school_id');
            $table->foreignId('monitor_id');
            $table->timestamps();
            $table->foreign('monitor_id')
                ->references('id')
                ->on('users');
            $table->foreign('parent_school_id')
                ->references('id')
                ->on('parent_schools');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parent_school_assistance_monitors');
    }
};
