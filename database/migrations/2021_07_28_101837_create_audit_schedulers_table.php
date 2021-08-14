<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditSchedulersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_schedulers', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->integer('site_id');
            $table->integer('contractor_id');
            $table->date('date_of_audit');
            $table->string('audit_type');
            $table->date('audit_from');
            $table->date('audit_to');
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('audit_schedulers');
    }
}
