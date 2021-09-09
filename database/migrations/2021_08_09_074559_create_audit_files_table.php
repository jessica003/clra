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
            $table->unsignedBigInteger('fk_audit_scheduler_id');
            $table->unsignedBigInteger('fk_audit_column_id');
            $table->date('particular_date');
            $table->string('particular_file')->nullable();
            $table->string('text_content')->nullable();
            $table->date('clra_from');
            $table->date('clra_to');
            $table->boolean('na')->default(false);
            $table->string('remarks')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->foreign('fk_audit_scheduler_id')->references('id')->on('audit_schedulers')->onDelete('cascade');
            $table->foreign('fk_audit_column_id')->references('id')->on('audit_columns')->onDelete('cascade');
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
