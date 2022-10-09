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
        Schema::create('tunnels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('ip_server');
            $table->string('server');
            $table->string('ip_tunnel');
            $table->string('local-addrss');
            $table->string('url');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->string('api')->unique();
            $table->string('winbox')->unique();
            $table->string('web')->unique();
            $table->dateTime('expired');
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
        Schema::dropIfExists('tunnels');
    }
};
