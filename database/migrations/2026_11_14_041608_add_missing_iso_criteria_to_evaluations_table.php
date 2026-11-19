<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('system_evaluations')) {
            Schema::create('system_evaluations', function (Blueprint $table) {
                $table->id();
                $table->string('evaluator_name');
                $table->string('evaluator_role'); 
                $table->integer('functional_suitability')->default(5);
                $table->integer('performance_efficiency')->default(5);
                $table->integer('usability')->default(5);
                $table->integer('reliability')->default(5);
                $table->integer('security')->default(5);
                $table->integer('portability')->default(5);
                $table->text('comments')->nullable();
                $table->timestamps();
            });
        } else {
            Schema::table('system_evaluations', function (Blueprint $table) {
                if (!Schema::hasColumn('system_evaluations', 'performance_efficiency')) {
                    $table->integer('performance_efficiency')->default(5)->after('functional_suitability');
                }
                if (!Schema::hasColumn('system_evaluations', 'portability')) {
                    $table->integer('portability')->default(5)->after('security');
                }
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('system_evaluations');
    }
};