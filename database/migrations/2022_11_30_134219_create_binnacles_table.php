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
        Schema::create('binnacles', function (Blueprint $table) {
            // Get the value of the arrays [select default]
            $binnacles = array_column(config('selectsDefault.binnacles'), 'value');
            $activationMode = array_column(config('selectsDefault.activation_mode'), 'value');
            $lineaments = array_column(config('selectsDefault.lineaments'), 'value');

            $table->id();
            $table->string('consecutive')->nullable();

            $table->foreignId('nac_id')->constrained()->onDelete('cascade');
            $table->foreignId('expertise_id')->constrained()->onDelete('cascade');
            $table->foreignId('orientation_id')->constrained()->onDelete('cascade');
            $table->foreignId('cultural_right_id')->constrained()->onDelete('cascade');

            $table->foreignId('pec_id')->nullable()->constrained();
            $table->foreignId('pedagogical_id')->nullable()->constrained();

            $table->enum('binnacle_id', $binnacles);
            $table->enum('lineament_id', $lineaments);
            $table->enum('activation_mode', $activationMode)->default('presencial');
            $table->enum('goals_met', ['si', 'no']);
            $table->enum('type',['other','manager']);

            $table->time('start_time');
            $table->time('final_hour');

            $table->string('activity_name');
            $table->text('start_activity');
            $table->text('activity_development');
            $table->text('end_of_activity');
            $table->text('observations_activity');
            $table->string('place');
            $table->text('experiential_objective');
            $table->text('explain_goals_met');
            $table->string('development_activity_image')->nullable();
            $table->string('evidence_participation_image')->nullable();

            $table->date('activity_date');

            $table->enum('status', ['REC','REV','ENREV','APRO'])->default('ENREV');
            $table->enum('audited', [0,1])->default(0);
            $table->text('reject_message')->nullable();

            // Aforo
            $table->string('beneficiaries_capacity',50)->nullable();
            $table->string('beneficiaries_or_capacity',50)->nullable();

            $table->text('aforo_file')->nullable();
            // $table->integer('assistants')->nullable();

             // Relation creator user
             $table->unsignedBigInteger('created_by')->nullable();
             $table->foreign('created_by')
                 ->references('id')
                 ->on('users');

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
        Schema::dropIfExists('binnacles');
    }
};
