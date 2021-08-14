<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_files', function (Blueprint $table) {
            $table->id();
            $table->integer('audit_id');
            $table->integer('particular_id');
            $table->date('particular_date');
            $table->string('particular_file')->nullable();
            $table->string('text_content')->nullable();
            $table->date('clra_from');
            $table->date('clra_to');
            $table->boolean('na')->default(false);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audit_files');
    }
}
