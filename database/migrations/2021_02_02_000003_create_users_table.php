<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->datetime('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('phone_primary')->nullable();
            $table->string('phone_secundary')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('sex')->nullable();
            $table->integer('active')->nullable();
            $table->string('customer_user_otrs')->nullable();
            $table->integer('first_access')->nullable();
            $table->integer('cliente')->nullable();
            $table->integer('endereco_cliente')->nullable();
            $table->string('preferencia')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
