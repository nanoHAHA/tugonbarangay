<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('incidents', function (Blueprint $table) {
            if (!Schema::hasColumn('incidents', 'latitude')) {
                $table->string('latitude')->nullable()->after('location');
            }
            if (!Schema::hasColumn('incidents', 'longitude')) {
                $table->string('longitude')->nullable()->after('latitude');
            }
            if (!Schema::hasColumn('incidents', 'admin_remarks')) {
                $table->text('admin_remarks')->nullable()->after('status');
            }
            if (!Schema::hasColumn('incidents', 'verified_by')) {
                $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('incidents', function (Blueprint $table) {
            if (Schema::hasColumn('incidents', 'verified_by')) {
                $table->dropForeign(['verified_by']);
                $table->dropColumn('verified_by');
            }
            $cols = array_filter(['latitude', 'longitude', 'admin_remarks'], fn($col) => Schema::hasColumn('incidents', $col));
            if (!empty($cols)) {
                $table->dropColumn($cols);
            }
        });
    }
};