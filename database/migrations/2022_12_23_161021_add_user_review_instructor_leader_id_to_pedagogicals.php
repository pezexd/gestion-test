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
        Schema::table('pedagogicals', function (Blueprint $table) {
            $table->foreignId('user_review_instructor_leader_id')->nullable();
            $table->foreign('user_review_instructor_leader_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedagogicals', function (Blueprint $table) {
            $table->dropColumn('user_review_instructor_leader_id');
        });
    }
};
