<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::create('inojob', function (Blueprint $table) {
            $table->id();
            $table->integer('group_id');
            $table->unsignedBigInteger('employee_id');
            $table->string('emp');
            $table->integer('status');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image');
            $table->string('location');
            $table->string('propeties');
            $table->string('pin');
            $table->string('major')->default('[]');
            $table->string('date');
            $table->string('count');
            $table->string('facilities');
            $table->string('degrees');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inoje');
    }
};
