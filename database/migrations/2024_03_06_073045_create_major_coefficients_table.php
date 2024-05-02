<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('major_coefficients', function (Blueprint $table) {
            $table->id();
            $table->integer('university_id');
            $table->string('university' , 1000);
            $table->integer('field_id');
            $table->string('major' , 1000);
            $table->string('bachelor' , 100);
            $table->string('master' , 100);
            $table->string('phd' , 100);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('major_coefficients');
    }
};
