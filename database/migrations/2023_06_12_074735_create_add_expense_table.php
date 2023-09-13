<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddExpenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_expense', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('m_name');
            $table->integer('c_id');
            $table->string('amount');
            $table->string('currency');
            $table->integer('mile');
            $table->integer('m_amount');
            $table->integer('totalm_amount');
            $table->string('payment_mode');
            $table->string('paid_through');
            $table->string('description');

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
        Schema::dropIfExists('add_expense');
    }
}
