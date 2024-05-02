<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('#festival_levels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('festival_type_id');
            $table->foreign('festival_type_id')->references('id')->on('#festival_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('#festival_levels');
    }
};
