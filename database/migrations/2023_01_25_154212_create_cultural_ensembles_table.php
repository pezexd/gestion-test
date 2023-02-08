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
        Schema::create('cultural_ensembles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()
            ->onDelete('cascade');
            $table->date('date')->nullable();
            $filter_level = array_column(config('selectsDefault.filter_level'), 'value');
            $table->enum('filter_level', $filter_level);
            $table->foreignId('pec_id')->nullable()->constrained();
            //datasheet_planning
            $table->integer('datasheet_planning');
            $table->text('description');
            $table->string('assembly_characteristics');
            $table->string('objective_process');
            $table->string('public_characteristics');

            $table->foreignId('cultural_right_id')->constrained()->onDelete('cascade');
            $lineaments = array_column(config('selectsDefault.lineaments'), 'value');
            $table->enum('lineament_id', $lineaments);
            $table->foreignId('orientation_id')->constrained()->onDelete('cascade');
            $value = array_column(config('selectsDefault.values'), 'value');
            $table->enum('value', $value);
            $table->string('artistic_expertise');
            $table->integer('evaluate_aspects');
            $table->string('evaluate_aspects_comments');
            /*
            Se genera string por si se almacena como ruta
            en caso contrario se debe generar de tipo blob o binary*
            */
            $table->string('aforo_pdf');
            $table->integer('number_attendees');
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
        Schema::dropIfExists('cultural_ensembles');
    }
};
