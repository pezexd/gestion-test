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
        Schema::create('parent_school_added_wizards', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('parent_school_id');
            $table->foreignId('assistant_id');
            $table->timestamps();

            $table->foreign('assistant_id')
                ->references('id')
                ->on('assistants');
            $table->foreign('parent_school_id')
                ->references('id')
                ->on('parent_schools');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parent_school_added_wizards');
    }
};
