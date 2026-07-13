<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('flash_infos', function (Blueprint $table) {
            if (! Schema::hasColumn('flash_infos', 'slug')) {
                $table->string('slug')->nullable()->after('content');
            }
        });
    }

    public function down(): void
    {
        Schema::table('flash_infos', function (Blueprint $table) {
            if (Schema::hasColumn('flash_infos', 'slug')) {
                $table->dropColumn('slug');
            }
        });
    }
};
