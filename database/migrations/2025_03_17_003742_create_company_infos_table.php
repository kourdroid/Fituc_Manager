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
            $table->integer('year_created')->nullable(); // Year of troupe creation
$table->enum('director_type', ['professional', 'amateur'])->nullable(); // Director type
            $table->string('repertoire')->nullable();
            $table->text('additional_info')->nullable();
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
