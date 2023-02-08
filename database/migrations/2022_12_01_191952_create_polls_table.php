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
        Schema::create('polls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('neighborhood_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('entity_name_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('other_entity_name')->nullable();
            $table->enum('gender', array('M','F','LGBTIQ+','O'));
            $table->char('age');
            $table->date('birth_date');
            $table->enum('marital_state', array('S','C', 'CV', 'R','UL','D','V'));
            $table->enum('stratum', array('1','2','3','4','5','6'));
            $table->string('other_neighborhoods')->nullable();
            $table->string('phone',20);
            $table->string('email');
            $table->char('number_children')->nullable();
            $table->char('dependents',10)->nullable();
            $table->enum('relationship_head_household', array('E','H','JH','F'));
            $table->enum('ethnicity', array('AFRO','IND','ROM','PAL','RAI','N'));
            $table->enum('victim_armed_conflict', array(1,0));
            $table->string('single_registry_victims')->nullable();
            $table->enum('study', array(1,0));
            $table->enum('educational_level', array('N','PREE','PRI','BAC','TEC','TECN','PRE','POS'))->nullable();
            $table->enum('medical_service', array('S','C'));
            $table->enum('health_condition', array('B','R','M'));
            $table->enum('takes_medication', array(1,0));
            $table->enum('suffers_disease', array(1,0));
            $table->enum('type_disease', array('CV','R','OM','N','O'))->nullable();
            // 'I','M', 'CV', 'R','C','S','N','E'
            $table->string('other_disease_type')->nullable();
            $table->enum('disability', array(1,0));
            $table->string('disability_type')->nullable();
            $table->string('other_disability_type')->nullable();
            //F','I','M','V','A','S','Mu'
            $table->enum('assessed_disability', array(1,0))->nullable();
            $table->enum('receives_therapy', array(1,0))->nullable();
            $table->string('expertises');
            $table->string('artistic_experience');
            $table->enum('artistic_group', array(1,0));
            $table->string('artistic_group_name')->nullable();
            $table->string('role_artistic_group')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('polls');
    }
};
