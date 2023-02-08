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
        Schema::create('methodological_sheets_one', function (Blueprint $table) {
            $table->id();
            $table->string('datasheet')->nullable();
            $table->string('consecutive')->nullable();
            $table->enum('status', ['REC', 'REV', 'ENREV', 'APRO'])->default('ENREV');

            $table->string('semillero_name');
            $table->date('date_range');

            $table->foreignId('group_id')->constrained()
                ->onDelete('cascade');
            $table->foreignId('cultural_right_id')->constrained()
                ->onDelete('cascade');
            $table->foreignId('orientation_id')->constrained()
                ->onDelete('cascade');

            $lineaments = array_column(config('selectsDefault.lineaments'), 'value');
            $table->enum('lineament_id', $lineaments);

            $filter_level = array_column(config('selectsDefault.filter_level'), 'value');
            $table->enum('filter_level', $filter_level);

            $value = array_column(config('selectsDefault.values'), 'value');
            $table->enum('value', $value);

            $table->text('worked_expertise');
            $table->text('characteristics_process');
            $table->text('objective_process');
            $table->text('comments');

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
        Schema::dropIfExists('methodological_sheets_one');
    }
};
