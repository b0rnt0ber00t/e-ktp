<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->bigInteger('nik')->unique()->primary();
            $table->string('kk');
            $table->string('place');
            $table->date('birth_date');
            $table->string('gender');
            $table->string('blood_type');
            $table->string('rt', 4);
            $table->string('rw', 4);
            $table->string('city');
            $table->string('village');
            $table->string('district');
            $table->text('address');
            $table->string('citizenship');
            $table->string('religion');
            $table->string('profession');
            $table->string('marriage');
            $table->string('image_KK');
            $table->string('transfer_certificate')->nullable();
            $table->string('Certificate_moving_foreign')->nullable();
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
        Schema::dropIfExists('user_details');
    }
}
