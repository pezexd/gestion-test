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
        Schema::create('psychopedagogical_logbook_added_wizards', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('psychopedagogical_logbook_id');
            $table->string('assistant_name');
            $table->string('assistant_document_number', 11);
            $table->string('assistant_position');
            $table->foreignId('nac_id');
            $table->string('assistant_phone', 11);
            $table->string('assistant_email')->nullable(true);
            $table->timestamps();

            $table->foreign('nac_id')
                ->references('id')
                ->on('nacs');

            $table->foreign('psychopedagogical_logbook_id', 'psychologbook_added_wizardsid_id_foreign')
                ->references('id')
                ->on('psychopedagogical_logbooks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('psychopedagogical_logbook_added_wizards');
    }
};
