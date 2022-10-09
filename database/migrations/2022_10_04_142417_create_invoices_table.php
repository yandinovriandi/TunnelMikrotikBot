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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('reference');
            $table->string('method')->nullable();
            $table->string('merchant_ref');
            $table->timestamp('paid_at')->nullable();
            $table->double('amount')->nullable();
            $table->text('description');
            $table->enum('status', ['UNPAID', 'PAID', 'EXPIRED'])->default('UNPAID');
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
        Schema::dropIfExists('invoices');
    }
};
