<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('settings')) {
            return;
        }

        $maxOrder = (int) DB::table('settings')->max('order');

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
                    'order' => ++$maxOrder,
                ],
            );
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('settings')) {
            return;
        }

        DB::table('settings')
            ->whereIn('key', [
                'stats.students_trained',
                'stats.establishments',
                'stats.experience_years',
                'stats.current_students',
            ])
            ->delete();
    }
};
