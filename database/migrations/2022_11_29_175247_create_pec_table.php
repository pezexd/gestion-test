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
        Schema::create('pecs', function (Blueprint $table) {
            $table->id();
            $table->string('consecutive')->nullable();
            $table->foreignId('nac_id')->constrained();
            $table->foreignId('neighborhood_id')->constrained();
            $table->string('place');
            $table->text('place_address');
            $table->date('activity_date');
            $table->time('start_time')->nullable();
            $table->time('final_hour')->nullable();
            $table->enum('place_type', ['F', 'P', 'SC', 'CEC', 'O']);
            $table->string('other_place_type')->nullable();
            $table->text('place_description');
            $table->text('place_image1')->nullable();
            $table->text('place_image2')->nullable();
            $table->enum('status', ['REC', 'REV', 'ENREV', 'APRO'])->default('ENREV');
            $table->enum('audited', [0,1])->default(0);
            $table->text('reject_message')->nullable();

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
        Schema::dropIfExists('pecs');
    }
};
