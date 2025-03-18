<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpcomingPerformancesTable extends Migration
{
    public function up()
    {
        Schema::create('upcoming_performances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->date('performance_date')->nullable();
            $table->string('performance_place')->nullable();
            $table->timestamps();

            $table->foreign('application_id')
                  ->references('id')->on('applications')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('upcoming_performances');
    }
}
