<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCastMembersTable extends Migration
{
    public function up()
    {
        Schema::create('cast_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->string('full_name');
            $table->string('passport_or_cin')->nullable();
            $table->integer('age')->nullable();
            $table->string('role_in_play')->nullable();
            $table->timestamps();

            $table->foreign('application_id')
                  ->references('id')->on('applications')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cast_members');
    }
}
