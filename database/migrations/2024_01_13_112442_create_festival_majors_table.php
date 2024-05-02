<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('#festival_majors', function (Blueprint $table) {
            $table->id();
            $table->string('name' , 500);
            $table->unsignedBigInteger('festival_level_id')->nullable();
            $table->foreign('festival_level_id')->references('id')->on('#festival_levels')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('#festival_majors');
    }
};
