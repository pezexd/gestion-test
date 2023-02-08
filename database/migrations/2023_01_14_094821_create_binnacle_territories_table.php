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
        Schema::create('binnacle_territories', function (Blueprint $table) {
            $table->id();
            $table->string('consecutive')->nullable();
            $table->foreignId('nac_id')->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('activity_date');
            $table->time('start_time');
            $table->time('final_hour');
            $table->string('place');
            $table->text('strategic_objectives_area');
            $table->text('purpose_visit');
            $table->text('topics_covered');
            $table->text('participants_perception');
            $table->text('problems_identified');
            $table->text('recommendations_actions');
            $table->text('comments_analysis');
            $table->string('development_activity_image')->nullable();
            $table->string('evidence_participation_image')->nullable();

            $table->enum('status', ['REC', 'REV', 'ENREV', 'APRO'])->default('ENREV');
            $table->text('reject_message')->nullable();

            // Relation creator user
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')
                ->references('id')
                ->on('users');

            // Relation reviewed user
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->foreign('reviewed_by')
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
        Schema::dropIfExists('binnacle_territories');
    }
};
