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
        Schema::create('inojob_groups', function (Blueprint $table) {
            $table->id();
            $table->integer('status');
            $table->string('title');
            $table->string('about',2500);
            $table->string('image');
            $table->string('type')->nullable();
            $table->string('category')->default('[]');
            $table->string('pin')->default('[]');
            $table->string('major')->default('[]');
            $table->string('count')->default('[
                "publishDate": null,
                "proposalDate" : null,
                "judgeDate" : null,
                "resultDate" : null,
                "lengthDate" : null
            ]'); 
            $table->json('facilities')->default('{
                "employerTest": null,
                "maxLab" : null,
                "offLab" : null,
                "subLab" : null,
                "repMilitary" : null,
                "minMilitary" : null,
                "maxMilitary" : null,
                "minPrice" : null,
                "maxPrice" : null
                
            }');
            $table->json('degrees')->default('{
                "bachelor": null,
                "master" : null,
                "doctor" : null,
            }'); 
            $table->json('properties')->default('{
                "حداقل هزینه خرید مواد اولیه": null,
                "حداکثر هزینه خرید مواد اولیه" : null,
                "trl" : null
            }'); 
            
            $table->string('judges')->nullable()->default('[]');
            $table->string('reviewers')->nullable()->default('[]');
            $table->integer('managers')->nullable()->default('10,505,3');
            

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
