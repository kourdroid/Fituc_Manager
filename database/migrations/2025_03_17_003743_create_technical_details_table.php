<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnicalDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('technical_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->text('description')->nullable();
            $table->string('scene_dimensions')->nullable();
            $table->string('assembling_time')->nullable();
            $table->string('disassembling_time')->nullable();
            $table->text('lighting_plan')->nullable();
            $table->text('costumes')->nullable(); // Costumes
            $table->text('accessories')->nullable(); // Accessories
            $table->text('sound_setup')->nullable();
            $table->timestamps();

            $table->foreign('application_id')
                  ->references('id')->on('applications')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('technical_details');
    }
}
