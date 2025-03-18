<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipationHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('participation_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->string('event_name')->nullable();
            $table->string('event_country')->nullable();
            $table->string('play_title')->nullable();
            $table->string('prizes')->nullable();
            $table->integer('num_representations')->nullable();
            $table->text('locations')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();

            $table->foreign('application_id')
                  ->references('id')->on('applications')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('participation_histories');
    }
}
