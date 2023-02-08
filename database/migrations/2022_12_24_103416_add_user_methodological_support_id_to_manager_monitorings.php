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
        Schema::table('manager_monitorings', function (Blueprint $table) {
            $table->foreignId('user_method_support_id')->nullable();
            $table->foreign('user_method_support_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manager_monitorings', function (Blueprint $table) {
            $table->dropColumn('user_method_support_id');
        });
    }
};
