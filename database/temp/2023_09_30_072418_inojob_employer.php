<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

     //id - groupId - status - title - employertype - site - location - salary -  publishDate - endDate - count() - experience - degree -  - extra - facilities - major - 
    public function up(): void
    {
        Schema::create('inojob_empoyer', function (Blueprint $table) {
            $table->id();
            $table->integer('status');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image');
            $table->string('count')->default('{
                "requests": 0,
            }');
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
