<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            if (!Schema::hasColumn('destinations', 'latitude')) {
                $table->decimal('latitude', 10, 7)->nullable()->after('slug');
            }
            if (!Schema::hasColumn('destinations', 'longitude')) {
                $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            }
            if (!Schema::hasColumn('destinations', 'province')) {
                $table->string('province', 120)->nullable()->after('title');
            }
        });

        Schema::table('articles', function (Blueprint $table) {
            if (!Schema::hasColumn('articles', 'latitude')) {
                $table->decimal('latitude', 10, 7)->nullable()->after('slug');
            }
            if (!Schema::hasColumn('articles', 'longitude')) {
                $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            }
        });
    }

    public function down(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude']);
        });
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude']);
        });
    }
};