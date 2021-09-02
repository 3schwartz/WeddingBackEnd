<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guestState', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('stateName');
            $table->timestamps();
        });

        Schema::table('guests', function (Blueprint $table) {
            $table->unsignedBigInteger('guestState_id')->nullable();
            $table->foreign('guestState_id')->references('id')->on('guestState')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guests');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('guestState_id');
        });
    }
}
