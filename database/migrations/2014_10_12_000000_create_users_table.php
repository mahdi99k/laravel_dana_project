<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name' , 255)->nullable();
            $table->string('last_name',255)->nullable();
            $table->longText('melli');
            $table->string('phone',11)->unique();
            $table->string('username', 255)->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('profile')->unique()->nullable();
            $table->string('bio')->nullable();
            $table->string('email')->unique();
            $table->string('birthday')->nullable();
            $table->longText('accounts');
            $table->longText('score');
            $table->longText('count');
            $table->longText('image');
            $table->longText('about');
            $table->longText('social');
            $table->longText('more');
            $table->longText('job');
            $table->longText('inojob');
            $table->string('status')->default('active');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->integer('is_admin')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
