<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
           $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('tracking_code')->unique();
            $table->string('title');
            $table->string('category'); 
            $table->text('description');
            $table->string('location');
            $table->string('evidence_path')->nullable();
            $table->enum('status', ['Pending', 'Verified', 'In Progress', 'Resolved', 'Rejected'])->default('Pending');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->text('admin_remarks')->nullable();
            $table->timestamps();
            $table->string('evidence')->nullable();
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};