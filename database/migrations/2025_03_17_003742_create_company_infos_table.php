<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyInfosTable extends Migration
{
    public function up()
    {
        Schema::create('company_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->integer('founded_year')->nullable(); // Year of troupe creation
            $table->text('background')->nullable(); // Company background
            $table->string('repertoire_style')->nullable(); // Repertoire style
            $table->string('already_played')->nullable(); // Whether the play has already been performed
            $table->integer('actors_count')->nullable(); // Number of actors
            $table->timestamps();

            $table->foreign('application_id')
                  ->references('id')->on('applications')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_infos');
    }
}
