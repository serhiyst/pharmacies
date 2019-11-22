<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmaciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('legal_entity');
            $table->string('address');
            $table->string('city');
            $table->string('district');

            $table->string('sales_rep');
            $table->string('category');
            $table->string('day_of_order');
            $table->string('day_of_delivery');
            $table->string('equipment')->nullable();

            $table->string('pharmacy_manager')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            
            $table->timestamps();   
        });

        Schema::table('pharmacies', function (Blueprint $table) {
            $table->foreign('sales_rep')->references('name')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pharmacies');
    }
}
