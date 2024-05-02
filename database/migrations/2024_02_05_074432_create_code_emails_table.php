<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('code_emails', function (Blueprint $table) {
            $table->id();
            $table->string('email', 2050);
            $table->string('code', 10);
            $table->timestamp('expire');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('code_emails');
    }
};
