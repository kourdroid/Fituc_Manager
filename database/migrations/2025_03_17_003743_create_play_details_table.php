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
            $table->string('language')->nullable();
            $table->date('premiere_date')->nullable();
            $table->text('english_summary')->nullable();
            $table->text('french_summary')->nullable();
            $table->text('arabic_summary')->nullable();
            $table->string('play_link')->nullable();
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
