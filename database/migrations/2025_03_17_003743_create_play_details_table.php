<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('play_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->string('play_title');
            $table->string('director')->nullable();
            $table->string('author')->nullable();
            $table->integer('duration')->nullable(); // duration in minutes
            $table->text('summary_en')->nullable(); // English
            $table->text('summary_fr')->nullable(); // French
            $table->text('summary_ar')->nullable(); // Arabic            $table->string('play_link')->nullable();
            $table->timestamps();

            $table->foreign('application_id')
                  ->references('id')->on('applications')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('play_details');
    }
}
