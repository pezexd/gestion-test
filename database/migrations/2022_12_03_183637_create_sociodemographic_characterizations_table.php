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
        Schema::create('socio_demos', function (Blueprint $table) {
            // $table->foreignId('entity_name_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('socio_demo_id');
            $table->string('socio_demo_type');
            $table->primary(['socio_demo_id','socio_demo_type']);
            // $table->foreignId('beneficiary_id')->nullable()->constrained()->onDelete('cascade');
            // $table->foreignId('attendant_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('age',2);
            $table->enum('gender', ['M','F','LGBTIQ+','O']);
            $table->enum('decision_study', [1,0])->default(0);
            $table->enum('educational_level', ['N','PREE','PRI','BAC','TEC','TECN','PRE','POS']);
            $table->enum('decision_disability', [1,0])->default(0);
            $table->enum('disability_type', ['F','V','A','C','M','MUL','N'])->default('N');
            $table->enum('ethnicity', ['AFRO','IND','ROM','PAL','RAI','N']);
            $table->enum('condition', ['D','MCH','CI','OH','NA']);
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
        Schema::dropIfExists('socio_demos');
    }
};
