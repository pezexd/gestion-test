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
        Schema::create('methodological_instructions', function (Blueprint $table) {
            $table->id();
            $table->string('place');
            $table->date('activity_date');
            $table->time('start_time');
            $table->time('final_hour');

            $table->foreignId('expertise_id')->constrained()->onDelete('cascade');
            $table->foreignId('nac_id')->constrained()->onDelete('cascade');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')
                ->references('id')
                ->on('users');

            $table->enum('goals_met', ['si', 'no']);

            $table->text('explanation');
            $table->text('pedagogical_comments');
            $table->text('technical_practical_comments');
            $table->text('methodological_comments');
            $table->text('others_observations');

            $table->string('place_file1')->nullable();
            $table->string('place_file2')->nullable();

            $table->string('consecutive')->nullable();
            $table->enum('status', ['REC','REV','ENREV','APRO'])->default('ENREV');
            $table->enum('audited', [0,1])->default(0);
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
        Schema::dropIfExists('methodological_instructions');
    }
};
