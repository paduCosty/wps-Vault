<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('invoice_number');
            $table->date('due_date');
            $table->enum('payment_term', ['7', '12', '14'])->default('7');
            $table->enum('currency', ['ron', 'eur', 'usd']);
            $table->enum('type', ['general'])->default('general');
            $table->enum('status', ['sent', 'pending', 'paid', 'unpaid'])->default('pending');
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
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['customer_id']);
        });

        Schema::dropIfExists('invoices');
    }
};