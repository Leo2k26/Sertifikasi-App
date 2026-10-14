<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pesertas', function (Blueprint $table) {
            if (!Schema::hasColumn('pesertas', 'status')) {
                $table->string('status')->default('pending')->after('skema_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pesertas', function (Blueprint $table) {
            if (Schema::hasColumn('pesertas', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
