<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_notifs', function (Blueprint $table) {
            $table->id();
            $table->string('patientFName');
            $table->string('patientLName');
            $table->string('patientCIN');
            $table->string('patientContact');
            $table->string('patientSex');
            $table->string('appDesc');
            $table->string('speciality');
            $table->foreignId('appId')->constrained('appointments')->onDelete('cascade')->onUpdate('cascade');
            $table->date('planDate');
            $table->Time('appTime');
            $table->string('appStatus');
            $table->string('planDoc');
            $table->string('appType');
            $table->string('appPaiement');
            $table->string('adminR');
            $table->string('notifStatus');
            $table->date('patientNais');
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
        Schema::dropIfExists('app_notifs');
    }
};
