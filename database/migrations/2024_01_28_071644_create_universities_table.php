<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('#universities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 500);
            $table->integer('grantin');
            $table->integer('code');
            $table->foreignId('province_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('#universities');
    }
};
