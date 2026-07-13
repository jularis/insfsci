<?php

namespace Database\Seeders;

use App\Models\FlashInfo;
use Illuminate\Database\Seeder;

class FlashInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FlashInfo::create([
            'title' => 'Concours session 2026',
            'excerpt' => 'Les inscriptions sont ouvertes pour le concours d\'entrée.',
            'content' => 'Les inscriptions pour le concours d\'entrée à l\'INSFS session 2026 sont dorénavant ouvertes.',
            'order' => 1,
            'is_active' => true,
        ]);

        FlashInfo::create([
            'title' => 'Journée portes ouvertes',
            'excerpt' => 'Visite libre de l\'INSFS le 28 mai 2026.',
            'content' => 'Venez découvrir les programmes et installations de l\'INSFS lors de notre journée portes ouvertes.',
            'order' => 2,
            'is_active' => true,
        ]);

        FlashInfo::create([
            'title' => 'Formation continue',
            'excerpt' => 'Nouvelles sessions disponibles en juin 2026.',
            'content' => 'Les inscriptions sont ouvertes pour nos sessions de formation continue en travail social.',
            'order' => 3,
            'is_active' => true,
        ]);

        FlashInfo::create([
            'title' => 'Rencontre pédagogique',
            'excerpt' => 'Visite de directeurs d\'établissements partenaires.',
            'content' => 'Une rencontre sera organisée avec les directeurs de nos établissements partenaires.',
            'order' => 4,
            'is_active' => true,
        ]);
    }
}
