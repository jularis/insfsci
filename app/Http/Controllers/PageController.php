<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use App\Models\Category;
use App\Models\Communique;
use App\Models\Etablissement;
use App\Models\Galerie;
use App\Models\Institut;
use App\Models\Service;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'services' => $this->contentList(Service::class, []),
            'establishments' => $this->establishmentsData(),
            'gallery' => $this->galleryData(),
            'stats' => $this->stats(),
            'news' => $this->contentList(Actualite::class, []),
            'sliders' => Slider::where('status', 'ACTIVE')
                ->orderBy('id')
                ->get()
                ->map(function ($slider) {
                    $slider->title = $this->normalizeText($slider->title);
                    $slider->body = $this->normalizeText($slider->body);

                    return $slider;
                }),
            'flashInfos' => [],
            'director' => $this->directorData(),
        ]);
    }

    private function directorData(): ?array
    {
        $director = Institut::where('slug', 'directeur')
            ->where('status', 'PUBLISHED')
            ->first();

        if (! $director) {
            return null;
        }

        return $this->normalizeModelContent($director);
    }

    public function institut()
    {
        return view('pages.institut');
    }

    public function institutDetail(string $slug)
    {
        $institut = Institut::where('slug', $slug)
            ->where('status', 'PUBLISHED')
            ->firstOrFail();

        return view('pages.detail', [
            'section' => 'Institut',
            'backRoute' => route('institut'),
            'item' => $this->normalizeModelContent($institut),
        ]);
    }

    public function etablissements()
    {
        return view('pages.etablissements', [
            'establishments' => $this->contentList(Etablissement::class, $this->establishmentsData()),
        ]);
    }

    public function etablissementDetail(string $slug)
    {
        return view('pages.detail', [
            'section' => 'Etablissements',
            'backRoute' => route('etablissements'),
            'item' => $this->contentDetail(Etablissement::class, $slug, $this->establishmentsData()),
        ]);
    }

    public function services()
    {
        return view('pages.services', [
            'services' => $this->contentList(Service::class, $this->servicesData()),
        ]);
    }

    public function serviceDetail(string $slug)
    {

        return view('pages.detail', [
            'section' => 'Services',
            'backRoute' => route('services'),
            'item' => $this->contentDetail(Service::class, $slug, $this->servicesData()),
        ]);
    }

    public function galerie()
    {
        $gallerySections = $this->gallerySections();

        return view('pages.galerie', [
            'gallerySections' => $gallerySections,
            'gallery' => collect($gallerySections)->flatMap(fn ($section) => $section['items'])->all(),
        ]);
    }

    public function galerieDetail(string $slug)
    {
        $item = Galerie::with('category')
            ->where('slug', $slug)
            ->where('status', 'PUBLISHED')
            ->first();

        if ($item) {
            return view('pages.detail', [
                'section' => 'Galerie',
                'backRoute' => route('galerie'),
                'item' => $this->normalizeModelContent($item),
            ]);
        }

        $category = Category::where('slug', $slug)->first();

        if ($category) {
            $gallerySections = $this->gallerySections($category->slug);

            return view('pages.galerie', [
                'gallerySections' => $gallerySections,
                'gallery' => collect($gallerySections)->flatMap(fn ($section) => $section['items'])->all(),
            ]);
        }

        return view('pages.detail', [
            'section' => 'Galerie',
            'backRoute' => route('galerie'),
            'item' => $this->contentDetail(Galerie::class, $slug),
        ]);
    }

    public function communiques()
    {
        return view('pages.communiques', [
            'communiques' => $this->contentList(Communique::class, $this->communiquesData()),
        ]);
    }

    public function communiqueDetail(string $slug)
    {
        return view('pages.detail', [
            'section' => 'Communiques',
            'backRoute' => route('communiques'),
            'item' => $this->contentDetail(Communique::class, $slug),
        ]);
    }

    public function actualites()
    {
        return view('pages.actualites', [
            'news' => $this->contentList(Actualite::class, []),
        ]);
    }

    public function actualiteDetail(string $slug)
    {
        return view('pages.detail', [
            'section' => 'Actualites',
            'backRoute' => route('actualites'),
            'item' => $this->contentDetail(Actualite::class, $slug),
        ]);
    }

    public function inscription()
    {
        return view('pages.inscription');
    }

    public function recrutement()
    {
        return view('pages.recrutement');
    }

    public function recherche(Request $request)
    {
        $query = trim((string) ($request->input('q') ?? $request->input('search')));

        return view('pages.recherche', [
            'query' => $query,
            'results' => $this->searchResults($query),
        ]);
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'min:15'],
        ]);

        return redirect()->route('contact')->with('success', 'Votre message a bien été envoyé. Nous vous répondrons rapidement.');
    }

    private function contentDetail(string $modelClass, string $slug, array $aliases = [])
    {
        $item = $modelClass::where('slug', $slug)
            ->where('status', 'PUBLISHED')
            ->first();

        if ($item) {
            return $this->normalizeModelContent($item);
        }

        $canonicalSlug = $this->canonicalSlug($slug, $aliases);

        if ($canonicalSlug === $slug) {
            $fallbackItem = collect($aliases)->firstWhere('slug', $slug);

            if ($fallbackItem) {
                return $this->normalizeContentArray($fallbackItem);
            }

            abort(404);
        }

        $item = $modelClass::where('slug', $canonicalSlug)
            ->where('status', 'PUBLISHED')
            ->first();

        if ($item) {
            return $this->normalizeModelContent($item);
        }

        $fallbackItem = collect($aliases)->firstWhere('slug', $canonicalSlug);

        if ($fallbackItem) {
            return $this->normalizeContentArray($fallbackItem);
        }

        abort(404);
    }

    private function canonicalSlug(string $slug, array $items): string
    {
        foreach ($items as $item) {
            if (in_array($slug, $item['aliases'] ?? [], true)) {
                return $item['slug'];
            }
        }

        return $slug;
    }

    private function contentList(string $modelClass, array $fallbackItems)
    {
        $items = $modelClass::where('status', 'PUBLISHED')
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        if ($items->isEmpty()) {
            return array_map(fn ($fallbackItem) => $this->normalizeContentArray($fallbackItem), $fallbackItems);
        }

        return $items->map(function ($item) {
            $title = $this->normalizeText($item->title);
            $excerpt = $this->normalizeText($item->excerpt);
            $body = $this->normalizeText($item->body);
            $bodyIntro = str(strip_tags((string) $body))->limit(220)->toString();

            return [
                'name' => $title,
                'title' => $title,
                'slug' => $item->slug,
                'excerpt' => $excerpt,
                'description' => $bodyIntro,
                'intro' => $bodyIntro,
                'body' => $body,
                'image' => $item->image_url,
                'date' => optional($item->created_at)->format('d/m/Y'),
                'requirements' => $excerpt,
                'objectives' => $bodyIntro,
            ];
        })->all();
    }

    private function gallerySections(?string $categorySlug = null): array
    {
        $query = Galerie::with('category')
            ->where('status', 'PUBLISHED')
            ->orderByDesc('created_at')
            ->limit(24);

        if ($categorySlug) {
            $query->whereHas('category', fn ($builder) => $builder->where('slug', $categorySlug));
        }

        return $query->get()
            ->map(fn ($item) => $this->normalizeModelContent($item))
            ->groupBy(fn ($item) => $item['category_slug'] ?? 'galerie')
            ->map(function ($items, $slug) {
                return [
                    'slug' => $slug,
                    'title' => $items->first()['category_name'] ?? 'Galerie',
                    'items' => $items->values()->all(),
                ];
            })
            ->sortBy(function ($section) {
                return match ($section['slug']) {
                    'photos' => 1,
                    'videos' => 2,
                    default => 10,
                };
            })
            ->values()
            ->all();
    }

    private function normalizeModelContent($item): array
    {
        $body = $this->normalizeText($item->body);
        $excerpt = $this->normalizeText($item->excerpt);
        $bodyIntro = str(strip_tags((string) $body))->limit(220)->toString();

        return [
            'name' => $this->normalizeText($item->title),
            'title' => $this->normalizeText($item->title),
            'slug' => $item->slug,
            'excerpt' => $excerpt ?: $bodyIntro,
            'description' => $bodyIntro,
            'intro' => $bodyIntro,
            'body' => $body,
            'image' => $item->image_url,
            'images' => $item instanceof Galerie ? $this->galleryImages($item) : [],
            'date' => optional($item->created_at)->format('d/m/Y'),
            'category_name' => $this->normalizeText($item->category->name ?? null),
            'category_slug' => $item->category->slug ?? null,
            'fichier' => isset($item->fichier) && $item->fichier ? $this->displayImageUrl($item->fichier) : null,
        ];
    }

    private function galleryImages(Galerie $item): array
    {
        $images = [];
        $rawImages = $item->getRawOriginal('images');
        $decodedImages = json_decode((string) $rawImages, true);

        if (is_array($decodedImages)) {
            foreach ($decodedImages as $image) {
                if (is_array($image)) {
                    $image = $image['download_link'] ?? $image['path'] ?? $image['image'] ?? null;
                }

                if (is_string($image) && trim($image) !== '') {
                    $images[] = $this->displayImageUrl($image);
                }
            }
        }

        if ($item->image_url) {
            array_unshift($images, $item->image_url);
        }

        return array_values(array_unique(array_filter($images)));
    }

    private function displayImageUrl(string $image): string
    {
        $image = str_replace('\\', '/', trim($image));

        if (Str::startsWith($image, ['http://', 'https://', '/'])) {
            return $image;
        }

        if (Str::startsWith($image, 'storage/')) {
            return asset($image);
        }

        if (file_exists(public_path($image))) {
            return asset($image);
        }

        return Storage::disk('public')->url($image);
    }

    private function normalizeContentArray(array $item): array
    {
        foreach (['name', 'title', 'excerpt', 'description', 'body', 'requirements', 'objectives'] as $key) {
            if (isset($item[$key])) {
                $item[$key] = $this->normalizeText($item[$key]);
            }
        }

        return $item;
    }

    private function normalizeText(?string $text): ?string
    {
        if ($text === null || $text === '') {
            return $text;
        }

        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $text = strtr($text, [
            'Ã©' => 'é',
            'Ã¨' => 'è',
            'Ãª' => 'ê',
            'Ã«' => 'ë',
            'Ã ' => 'à',
            'Ã¢' => 'â',
            'Ã´' => 'ô',
            'Ã¶' => 'ö',
            'Ã¹' => 'ù',
            'Ã»' => 'û',
            'Ã®' => 'î',
            'Ã¯' => 'ï',
            'Ã§' => 'ç',
            'Ã‰' => 'É',
            'Ãˆ' => 'È',
            'ÃŠ' => 'Ê',
            'Ã€' => 'À',
            'Ã‡' => 'Ç',
            'Â' => '',
            'â€™' => "'",
            'â€˜' => "'",
            'â€œ' => '"',
            'â€�' => '"',
            'â€“' => '-',
            'â€”' => '-',
            'â€¦' => '...',
        ]);

        return html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    private function servicesData(): array
    {
        return [
            [
                'name' => 'Service des Stages',
                'slug' => 'service-des-stages',
                'aliases' => ['stages'],
                'excerpt' => 'Accompagnement des étudiants en stage et suivi des partenariats professionnels.',
                'description' => 'A l’instar de toutes les formations professionnelles, celle des étudiants de l’Institut National Supérieur de Formation Sociale s’appuie sur des stages encadrés et une préparation concrète au monde du travail.',
            ],
            [
                'name' => 'Service Étude, Suivi et Évaluation',
                'slug' => 'service-etude-suivi-et-evaluation',
                'aliases' => ['service-d-etude-suivi-et-evaluation', 'service-etude-suivi-evaluation'],
                'excerpt' => 'Études, suivi des actions et évaluation des projets de formation.',
                'description' => 'Mener des études, assurer le suivi des séminaires, conférences et partenariats, et évaluer les actions de formation en travail social.',
            ],
            [
                'name' => 'Service de la Scolarité',
                'slug' => 'service-de-la-scolarite',
                'aliases' => ['le-service-de-la-scolarite', 'scolarite'],
                'excerpt' => 'Gestion administrative et pédagogique des cursus étudiants.',
                'description' => 'Dans son fonctionnement, l’Institut National de Formation Sociale dispose d’un service de scolarité dédié à l’organisation des formations, à l’accueil des étudiants et à la gestion des dossiers.',
            ],
            [
                'name' => 'Service Formation Continue et Recherche',
                'slug' => 'service-formation-continue-recherche',
                'aliases' => [
                    'service-de-la-formation-continue-et-de-la-recherche',
                    'service-de-la-formation-continue-et-de-la-recherche-en-travail-social',
                    'service-formation-continue-et-recherche',
                ],
                'excerpt' => 'Formation continue et recherche en travail social pour les professionnels.',
                'description' => 'La formation continue et la recherche en travail social font partie des missions essentielles de l’INSFS, en lien avec les besoins des institutions et des communautés.',
            ],
            [
                'name' => 'Service des Archives et Documentation',
                'slug' => 'service-des-archives-documentation',
                'aliases' => [
                    'service-des-archives-de-la-documentation-et-de-linformationsadi',
                    'service-des-archives-de-la-documentation-et-de-l-information-sadi',
                    'service-sadi',
                    'sadi',
                ],
                'excerpt' => 'Gestion des archives, de la documentation et de l’information professionnelle.',
                'description' => 'Le service des archives, de la documentation et de l’information représente l’épine dorsale documentaire de l’Institut, en garantissant l’accès aux ressources pédagogiques et scientifiques.',
            ],
            [
                'name' => 'Concours',
                'slug' => 'service-concours',
                'aliases' => ['concours'],
                'excerpt' => 'Information sur les concours directs et professionnels.',
                'description' => 'Information sur les modalites, les dates et les conditions de participation aux concours d\'entree a l\'INSFS.',
            ],
            [
                'name' => 'Economie',
                'slug' => 'service-economie',
                'aliases' => ['economie'],
                'excerpt' => 'Accompagnement economique et social.',
                'description' => 'Accompagnement economique et social pour les projets des etudiants et les activites de l\'institut.',
            ],
            [
                'name' => 'Autres services',
                'slug' => 'service-autres',
                'aliases' => ['autres-services'],
                'excerpt' => 'Services complementaires de l\'INSFS.',
                'description' => 'Services complementaires pour l\'inscription, les partenariats, l\'orientation et le conseil aux candidats.',
            ],
        ];
    }

    private function establishmentsData(): array
    {
        return [
            [
                'name' => 'École des Éducateurs Spécialisés',
                'slug' => 'ecole-des-educateurs-specialises',
                'aliases' => ['ecole-educateurs-specialises'],
                'excerpt' => 'Formation des éducateurs spécialisés pour la prise en charge des personnes en difficulté.',
                'requirements' => 'DUEL en sciences humaines ou diplôme d’Etat avec expérience professionnelle.',
                'objectives' => 'Former des professionnels capables d’accompagner des personnes handicapées ou en difficulté et d’intervenir en milieu institutionnel et ouvert.',
            ],
            [
                'name' => 'École des Éducateurs Préscolaires',
                'slug' => 'ecole-des-educateurs-prescolaires',
                'aliases' => ['ecole-educateurs-prescolaires'],
                'excerpt' => 'Préparation des éducateurs pour l’accueil et la prise en charge des jeunes enfants.',
                'requirements' => 'Diplôme d’Etat des Educateurs Préscolaires ou expérience équivalente.',
                'objectives' => 'Accompagner les enfants en bas âge dans les structures préscolaires et favoriser leur développement.',
            ],
            [
                'name' => 'École des Assistants Sociaux',
                'slug' => 'ecole-des-assistants-sociaux',
                'aliases' => ['ecole-assistants-sociaux'],
                'excerpt' => 'Formation des assistants sociaux pour l’intervention sociale et l’accompagnement de familles.',
                'requirements' => 'Diplôme d’Etat des Assistants Sociaux plus expérience professionnelle de 3 ans.',
                'objectives' => 'Permettre aux futurs assistants sociaux d’identifier les besoins et de créer des réponses appropriées en milieu social.',
            ],
            [
                'name' => 'CPPE-PILOTE',
                'slug' => 'cppe-pilote',
                'excerpt' => 'Programme pilote de formation professionnelle continue.',
                'requirements' => 'Professionnels du travail social, de l\'education ou candidats retenus selon les conditions du programme.',
                'objectives' => 'Renforcer les competences des professionnels du travail social et de l\'education.',
            ],
        ];
    }

    private function galleryData(): array
    {
        return [
            [
                'title' => 'Photos',
                'slug' => 'photos',
                'excerpt' => 'Retrouvez les temps forts de l\'INSFS en images : ceremonies, soutenances et evenements institutionnels.',
            ],
            [
                'title' => 'Videos',
                'slug' => 'videos',
                'excerpt' => 'Les videos de l\'institut sont en cours de preparation. Elles seront accessibles prochainement sur cette page.',
            ],
            [
                'title' => 'Cérémonie de remise de diplômes 2016',
                'slug' => 'ceremonie-remise-diplomes-2016',
                'excerpt' => 'Retour sur la cérémonie de remise de diplômes des promotions de l’INSFS.',
            ],
            [
                'title' => 'Soutenances de mémoire de fin de cycle 2016',
                'slug' => 'soutenances-memoire-2016',
                'excerpt' => 'Soutenances de la promotion de fin de cycle et présentation des mémoires.',
            ],
            [
                'title' => 'Cérémonie d’ouverture des soutenances 2016',
                'slug' => 'ceremonie-ouverture-soutenances-2016',
                'excerpt' => 'Ouverture officielle des soutenances de mémoire de fin de formation.',
            ],
        ];
    }

    private function communiquesData(): array
    {
        return [
            [
                'title' => 'Concours directs d’entrée à l’INSFS session 2026',
                'slug' => 'concours-directs-entree-2026',
                'date' => '15 avril 2026',
                'excerpt' => 'Informations importantes sur les modalités et les dates du concours d’entrée.',
            ],
            [
                'title' => 'Organisation de la rentrée académique 2026',
                'slug' => 'rentree-academique-2026',
                'date' => '05 mars 2026',
                'excerpt' => 'Calendrier et directives pour la rentrée des étudiants et des nouvelles promotions.',
            ],
        ];
    }

    private function news(): array
    {
        return [
            [
                'title' => 'Activités du directeur de l’INSFS',
                'slug' => 'activites-directeur-infs',
                'date' => '20 avril 2026',
                'excerpt' => 'Visite de certaines structures et rencontres avec les partenaires académiques.',
            ],
            [
                'title' => 'Lancement des sessions de formation continue',
                'slug' => 'sessions-formation-continue',
                'date' => '10 avril 2026',
                'excerpt' => 'Nouvelles inscriptions ouvertes pour la formation continue en travail social.',
            ],
            [
                'title' => 'Journée portes ouvertes de l’INSFS',
                'slug' => 'journee-portes-ouvertes',
                'date' => '28 mars 2026',
                'excerpt' => 'Découvrez les programmes et les opportunités offertes aux candidats.',
            ],
        ];
    }

    private function stats(): array
    {
        return [
            ['label' => 'Étudiants formés', 'value' => setting('site.students_trained', '0')],
            ['label' => 'Établissements', 'value' => setting('site.establishments', '0')],
            ['label' => 'Expériences', 'value' => setting('site.experience_years', '0')],
            ['label' => 'Étudiants en formation', 'value' => setting('site.current_students', '0')],
        ];
    }

    private function institutData(): array
    {
        return [
            [
                'title' => 'Presentation',
                'slug' => 'presentation',
                'excerpt' => 'Presentation generale de l\'Institut National Superieur de Formation Sociale.',
            ],
            [
                'title' => 'Directeur',
                'slug' => 'directeur',
                'excerpt' => 'Informations sur la direction de l\'INSFS.',
            ],
            [
                'title' => 'Sous-directeurs',
                'slug' => 'sous-directeurs',
                'excerpt' => 'Presentation des sous-directions et de leurs missions.',
            ],
            [
                'title' => 'Sous-directions',
                'slug' => 'sous-directions',
                'excerpt' => 'Organisation des sous-directions de l\'institut.',
            ],
        ];
    }

    private function searchResults(string $query): array
    {
        if ($query === '') {
            return [];
        }

        $results = [];

        $staticPages = [
            ['type' => 'Page', 'title' => 'Accueil', 'url' => route('home'), 'excerpt' => 'Bienvenue a l\'Institut National Superieur de Formation Sociale.'],
            ['type' => 'Page', 'title' => 'Institut', 'url' => route('institut'), 'excerpt' => 'Presentation, direction et organisation de l\'INSFS.'],
            ['type' => 'Page', 'title' => 'Etablissements', 'url' => route('etablissements'), 'excerpt' => 'Les ecoles et etablissements de formation sociale.'],
            ['type' => 'Page', 'title' => 'Services', 'url' => route('services'), 'excerpt' => 'Les services administratifs et pedagogiques de l\'institut.'],
            ['type' => 'Page', 'title' => 'Galerie', 'url' => route('galerie'), 'excerpt' => 'Photos et videos des activites de l\'INSFS.'],
            ['type' => 'Page', 'title' => 'Communiques', 'url' => route('communiques'), 'excerpt' => 'Les communiques officiels de l\'INSFS.'],
            ['type' => 'Page', 'title' => 'Actualites', 'url' => route('actualites'), 'excerpt' => 'Les dernieres nouvelles et activites de l\'institut.'],
            ['type' => 'Page', 'title' => 'Inscription', 'url' => route('inscription'), 'excerpt' => 'Informations sur les inscriptions et reinscriptions.'],
            ['type' => 'Page', 'title' => 'Recrutement', 'url' => route('recrutement'), 'excerpt' => 'Informations sur les concours, recrutements et opportunites.'],
            ['type' => 'Page', 'title' => 'Contact', 'url' => route('contact'), 'excerpt' => 'Contactez l\'INSFS pour toute demande d\'information.'],
        ];

        foreach ($staticPages as $page) {
            if ($this->matchesSearch($page['title'].' '.$page['excerpt'], $query)) {
                $results[] = $page;
            }
        }

        $results = array_merge(
            $results,
            $this->searchModel(Institut::class, 'Institut', 'institut.show', $query),
            $this->searchModel(Etablissement::class, 'Etablissement', 'etablissements.show', $query),
            $this->searchModel(Service::class, 'Service', 'services.show', $query),
            $this->searchModel(Galerie::class, 'Galerie', 'galerie.show', $query),
            $this->searchModel(Communique::class, 'Communique', 'communiques.show', $query),
            $this->searchModel(Actualite::class, 'Actualite', 'actualites.show', $query)
        );

        return array_values($results);
    }

    private function searchModel(string $modelClass, string $type, string $routeName, string $query): array
    {
        return $modelClass::where('status', 'PUBLISHED')
            ->where(function ($builder) use ($query) {
                $builder->where('title', 'like', "%{$query}%")
                    ->orWhere('excerpt', 'like', "%{$query}%")
                    ->orWhere('body', 'like', "%{$query}%");
            })
            ->orderByDesc('created_at')
            ->limit(10)
            ->get()
            ->map(function ($item) use ($type, $routeName) {
                $body = $this->normalizeText($item->body);
                $excerpt = $this->normalizeText($item->excerpt) ?: str(strip_tags((string) $body))->limit(180)->toString();

                return [
                    'type' => $type,
                    'title' => $this->normalizeText($item->title),
                    'url' => route($routeName, $item->slug),
                    'excerpt' => $excerpt,
                    'date' => optional($item->created_at)->format('d/m/Y'),
                ];
            })
            ->all();
    }

    private function matchesSearch(string $content, string $query): bool
    {
        return str_contains(strtolower($content), strtolower($query));
    }

}
