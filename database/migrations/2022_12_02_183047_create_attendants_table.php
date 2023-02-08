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
        Schema::create('attendants', function (Blueprint $table) {

            $table->id();

            $table->foreignId('beneficiary_id')->constrained()->onDelete('cascade');
            $table->string('full_name');
            $table->enum('type_document', ['RC', 'TI', 'CC']);
            $table->string('document_number',20);
            $table->enum('zone', ['U', 'R']);
            $table->enum('relationship',['P', 'M','PA','MA','T', 'PR', 'H', 'A', 'O']);
            $table->string('other_relationship')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
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
        Schema::dropIfExists('attendants');
    }
};
