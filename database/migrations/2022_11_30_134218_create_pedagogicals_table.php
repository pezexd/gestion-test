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
        Schema::create('pedagogicals', function (Blueprint $table) {
            $table->id();
            $table->string('consecutive')->nullable();
            // $table->unsignedBigInteger('monitor_id');
            // $table->foreign('monitor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('nac_id')->constrained()->onDelete('cascade');
            $table->foreignId('cultural_right_id')->constrained()->onDelete('cascade');
            $table->foreignId('expertise_id')->constrained()->onDelete('cascade');
            $table->foreignId('orientation_id')->constrained()->onDelete('cascade');
            // $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('activity_name')->nullable();
            $table->date('activity_date')->nullable()->unique();

            $table->text('experiential_objective')->nullable();
            $lineaments = array_column(config('selectsDefault.lineaments'), 'value');
            $table->enum('lineament_id', $lineaments);

            $table->text('manifestation')->nullable();
            $table->text('process')->nullable();
            $table->text('product')->nullable();
            $table->text('resources')->nullable();

            // Relation creator user
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')
                ->references('id')
                ->on('users');

            // $table->enum('type', ['monitor', 'manager'])->default('monitor');
            $table->enum('status', ['REC','REV','ENREV','APRO'])->default('ENREV');
            $table->enum('audited', [0,1])->default(0);
            $table->text('reject_message')->nullable();
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
        Schema::dropIfExists('pedagogicals');
    }
};
