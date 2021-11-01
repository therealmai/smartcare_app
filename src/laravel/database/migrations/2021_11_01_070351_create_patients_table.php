<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('userID');
            $table->string('specialization');
            $table->string('license_number');
            $table->string('degree');
            $table->timestamps();

            $table->foreign('userID')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('doctors_fees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('amount');
            $table->string('type');
            $table->timestamps();
            
            $table->foreign('userID')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('prescriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('doctor_id');
            $table->date('date');
            $table->string('text');
            $table->timestamps();

            $table->foreign('doctor_id')->references('id')->on('doctors');
        });
        
        Schema::create('doctors_lab_tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('prescriptionID'); 
            $table->string('test_name');
            $table->string('report');
            $table->timestamps();

            $table->foreign('prescriptionID')->references('id')->on('prescriptions')->onDelete('cascade');
        });

        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('testID');
            $table->unsignedBigInteger('prescriptionID');
            $table->string('height');
            $table->string('weight');
            $table->string('blood_pressure');
            $table->string('heart_rate');
            $table->timestamps();

            $table->foreign('userID')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('testID')->references('id')->on('doctors_lab_tests')->onDelete('cascade');
            $table->foreign('prescriptionID')->references('id')->on('prescriptions')->onDelete('cascade');
            
        });

        Schema::create('insurances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('feeID');
            $table->string('insurance_name');
            $table->string('policy');
            $table->string('main_policy_holder');
            $table->timestamps();

            $table->foreign('userID')->references('id')->on('users');
            $table->foreign('feeID')->references('id')->on('doctors_fees');
        });

        Schema::create('secretaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('referral');
            $table->string('name');
            $table->string('contact');
            $table->timestamps();
            
        });

        Schema::create('emergency_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('relationship');
            $table->string('contact');
            $table->timestamps();
        });

        Schema::create('payer_for_patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('feeID');
            $table->string('name');
            $table->string('relationship');
            $table->string('contact');
            $table->string('address');
            $table->tinyInteger('age');
            $table->string('gender');
            $table->timestamps();


            $table->foreign('feeID')->references('id')->on('doctors_fees');
        });

        Schema::create('doctors_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('time');
            $table->date('date');
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
        Schema::dropIfExists('doctors');
        Schema::dropIfExists('doctors_fees');
        Schema::dropIfExists('doctors_lab_tests');
        Schema::dropIfExists('patients');
        Schema::dropIfExists('insurances');
        Schema::dropIfExists('secretaries');
        Schema::dropIfExists('emergency_contacts');
        Schema::dropIfExists('payer_for_patients');
        Schema::dropIfExists('doctors_schedules');
        Schema::dropIfExists('prescriptions');
    }
}
