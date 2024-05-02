<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('#inojob_cases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('last_admin', 1000)->nullable();
            $table->integer('score');
            $table->integer('status');
            $table->integer('step');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('#inojob_cases');
    }
};
