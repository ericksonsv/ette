<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('order_id')->constrained();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->date('date');
            $table->time('time');
            $table->string('flight')->nullable();
            $table->time('flight_time')->nullable();
            $table->unsignedBigInteger('passengers')->nullable();
            $table->string('pickup');
            $table->string('dropoff');
            $table->string('type')->defautl('Standard');
            $table->string('currency')->default('DOP');
            $table->float('amount', 8, 2)->default(0);
            $table->string('status')->default('Pending');
            $table->text('note')->nullable();
            $table->boolean('editable')->default(true);
            $table->string('url')->nullable();
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
        Schema::dropIfExists('services');
    }
}
