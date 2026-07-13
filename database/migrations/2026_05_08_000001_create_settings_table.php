<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                $table->string('key')->unique();
                $table->string('display_name')->nullable();
                $table->text('value')->nullable();
                $table->text('details')->nullable();
                $table->string('type')->default('text');
                $table->integer('order')->default(1);
                $table->string('group')->nullable();
            });
        }

        Schema::table('settings', function (Blueprint $table) {
            if (! Schema::hasColumn('settings', 'display_name')) {
                $table->string('display_name')->nullable()->after('key');
            }

            if (! Schema::hasColumn('settings', 'value')) {
                $table->text('value')->nullable()->after('display_name');
            }

            if (! Schema::hasColumn('settings', 'details')) {
                $table->text('details')->nullable()->after('value');
            }

            if (! Schema::hasColumn('settings', 'type')) {
                $table->string('type')->default('text')->after('details');
            }

            if (! Schema::hasColumn('settings', 'order')) {
                $table->integer('order')->default(1)->after('type');
            }

            if (! Schema::hasColumn('settings', 'group')) {
                $table->string('group')->nullable()->after('order');
            }
        });

        $order = 1;

        foreach ([
            'site.address' => 'Adresse',
            'site.email' => 'Email',
            'site.communication_service' => 'Service communication',
            'site.linkedin_url' => 'LinkedIn',
            'site.facebook_url' => 'Facebook',
            'site.instagram_url' => 'Instagram',
            'site.youtube_url' => 'YouTube',
            'site.twitter_url' => 'X / Twitter',
        ] as $key => $label) {
            DB::table('settings')->updateOrInsert(
                ['key' => $key],
                [
                    'display_name' => $label,
                    'type' => 'text',
                    'group' => 'site',
                    'order' => $order++,
                ],
            );
        }

        foreach ([
            'stats.students_trained' => ['label' => 'Chiffres clés - Étudiants formés', 'value' => '7968'],
            'stats.establishments' => ['label' => 'Chiffres clés - Établissements', 'value' => '4'],
            'stats.experience_years' => ['label' => 'Chiffres clés - Expériences', 'value' => '25'],
            'stats.current_students' => ['label' => 'Chiffres clés - Étudiants en formation', 'value' => '1798'],
        ] as $key => $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $key],
                [
                    'display_name' => $setting['label'],
                    'value' => $setting['value'],
                    'type' => 'number',
                    'group' => 'stats',
                    'order' => $order++,
                ],
            );
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
