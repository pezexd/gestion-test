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
        Schema::table('psychopedagogical_logbooks', function (Blueprint $table) {
            $table->enum('status', ['REC','REV','ENREV','APRO'])->default('ENREV');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('psychopedagogical_logbooks', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
