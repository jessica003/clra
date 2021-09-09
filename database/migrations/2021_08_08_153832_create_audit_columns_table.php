<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_columns', function (Blueprint $table) {
            $table->id();
            $table->string('column_name')->nullable();
            $table->string('act_group_name')->nullable();
            $table->unsignedBigInteger('fk_audit_type_id');
            $table->foreign('fk_audit_type_id')->references('id')->on('audit_types')->onDelete('cascade');
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
        Schema::dropIfExists('audit_columns');
    }
}
