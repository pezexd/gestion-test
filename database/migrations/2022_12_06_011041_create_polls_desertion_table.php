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
        Schema::create('polls_desertion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('consecutive')->nullable();
            $table->foreignId('beneficiary_id')->nullable()->constrained()->onDelete('cascade');
            $table->date('date');
            $table->foreignId('nac_id')->constrained()->onDelete('cascade');
            $table->enum('beneficiary_attrition_factors', ['PF', 'PE', 'FT', 'OTRO']);
            $table->string('beneficiary_attrition_factor_other', 250)->nullable();
            $table->tinyInteger('disinterest_apathy')->comment('1: Si, 0: No')->default(0);
            $table->text('disinterest_apathy_explanation');
            $table->tinyInteger('reintegration')->comment('1: Si, 0: No')->default(0);
            $table->string('reintegration_explanation');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polls_desertion');
    }
};
