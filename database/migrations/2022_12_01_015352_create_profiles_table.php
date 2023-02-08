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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string("contractor_full_name");
            $table->string("document_number");

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('nac_id')->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            //$table->foreignId('neighborhood_id')->constrained()->onDelete('cascade');


            $table->unsignedBigInteger('gestor_id')->nullable();
            $table->foreign('gestor_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->unsignedBigInteger('psychosocial_id')->nullable();
            $table->foreign('psychosocial_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');


            $table->unsignedBigInteger('methodological_support_id')->nullable();
            $table->foreign('methodological_support_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->unsignedBigInteger('support_tracing_monitoring_id')->nullable();
            $table->foreign('support_tracing_monitoring_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->unsignedBigInteger('ambassador_leader_id')->nullable();
            $table->foreign('ambassador_leader_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->unsignedBigInteger('instructor_leader_id')->nullable();
            $table->foreign('instructor_leader_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

                // psychosocial coordinator
            /* $table->foreign('user_id', 'psychosocial_id')->constrained()->onDelete('cascade');
            $table->foreign('user_id', 'methodological_support_id')->constrained()->onDelete('cascade');
            $table->foreign('user_id', 'support_tracing_monitoring_id')->constrained()->onDelete('cascade'); */

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
        Schema::dropIfExists('profiles');
    }
};
