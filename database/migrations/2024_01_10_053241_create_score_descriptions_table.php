<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('#score_info', function (Blueprint $table) {
            $table->id();
            $table->string('cert', 255)->unique();
            $table->string('type', 255)->unique();
            $table->string('filter', 255)->nullable();
            $table->text('data');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('#score_info');
    }
};
