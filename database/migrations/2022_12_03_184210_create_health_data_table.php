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
        Schema::create('health_datas', function (Blueprint $table) {
            // $table->id();
            $table->unsignedBigInteger('health_data_id');
            $table->string('health_data_type');
            $table->primary(['health_data_id','health_data_type']);
            $table->foreignId('entity_name_id')->constrained()->onDelete('cascade');
            $table->string('other_entity_name')->nullable();
            $table->enum('medical_service', ['C','S']);
            $table->enum('health_condition', ['B', 'R', 'M']);
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
        Schema::dropIfExists('health_data');
    }
};
