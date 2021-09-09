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
            $table->id(); //by default it is unsignedIteger not Big in laravel below 6 or 7
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('site_id');
            $table->unsignedInteger('contractor_id');
            $table->date('date_of_audit');
            $table->unsignedBigInteger('fk_audit_type_id');
            $table->date('audit_from');
            $table->date('audit_to');
            $table->boolean('status')->default(false);
            $table->boolean('contractor_status')->default(0);
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
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
        Schema::dropIfExists('audit_schedulers');
    }
}
