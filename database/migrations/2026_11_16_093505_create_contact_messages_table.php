<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('contact_messages', function (Blueprint $table) {
        $table->id();
        $table->string('full_name');
        $table->string('contact_info'); 
        $table->text('message');
        $table->string('status')->default('Unread'); 
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
