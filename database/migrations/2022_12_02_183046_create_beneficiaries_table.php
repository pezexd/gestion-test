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
        Schema::create('beneficiaries', function (Blueprint $table) {

            $table->id();
            $table->foreignId('nac_id')->constrained()
                ->onDelete('cascade');
            $table->foreignId('neighborhood_id')->constrained()
                ->onDelete('cascade');
            $table->foreignId('created_by')->constrained()->onDelete('cascade')->on('users');
            $table->foreignId('group_id')->nullable();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->string('full_name');
            $table->string('institution_entity_referred')->nullable();
            $table->enum('accept', [1, 0]);
            $table->enum('linkage_project', ['PMIE', 'PMEPUB', 'PMEPRI', 'PMGCP', 'PMMCP', 'PMR']);
            $table->enum('participant_type', ['C', 'NC']);
            $table->enum('type_document', ['RC', 'TI', 'CC']);
            $table->string('document_number', 20)->unique();
            $table->string('neighborhood_new')->nullable();
            $table->enum('zone', ['U', 'R']);
            $table->char('stratum', 2);
            $table->string('phone');
            $table->string('email');
            $table->string('file')->nullable();
            $table->enum('status', ['REC', 'REV', 'ENREV', 'APRO'])->default('ENREV');
            $table->enum('audited', [0,1])->default(0);
            $table->text('reject_message')->nullable();
            $table->string('referrer_name')->nullable();
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
        Schema::dropIfExists('beneficiaries');
    }
};
