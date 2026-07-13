@extends('layouts.public')

@section('title', $item['name'] ?? $item['title'] ?? 'Detail')

@section('hide-slider', 'true')

@section('content')
    <div class="space-y-8">
        <div class="rounded-3xl bg-white p-4 shadow-sm ring-1 ring-slate-200">
            <nav class="flex flex-wrap items-center gap-4 text-sm text-slate-600">
                <a href="{{ route('home') }}" class="hover:text-red-600 transition">Accueil</a>
                <a href="{{ $backRoute }}" class="hover:text-red-600 transition">{{ $section }}</a>
                <span class="font-semibold text-slate-900">{{ $item['name'] ?? $item['title'] }}</span>
            </nav>
        </div>

        <article class="rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
            <p class="text-sm lowercase tracking-[0.24em] text-red-600">{{ $section }}</p>
            <h1 class="mt-4 text-4xl font-bold text-slate-900">{{ $item['name'] ?? $item['title'] }}</h1>

            @isset($item['date'])
                <p class="mt-4 text-sm lowercase tracking-[0.18em] text-slate-500">{{ $item['date'] }}</p>
            @endisset

            @php($image = is_object($item) ? ($item->image_url ?? $item->image) : ($item['image'] ?? null))



            <div class="mt-8 flow-root">
                @if($image)
                    <figure class="mb-6 overflow-hidden rounded-xl bg-slate-100 shadow-md shadow-slate-200 ring-1 ring-slate-200 md:float-left md:mb-4 md:mr-6 md:w-56 lg:w-64" >
                        <img src="{{ $image }}" alt="{{ $item['name'] ?? $item['title'] }}" class="h-auto w-full object-contain" loading="lazy">
                    </figure>
                @endif

                @isset($item['excerpt'])
                    <p class="text-slate-600 leading-8">{{ $item['excerpt'] }}</p>
                @endisset

                @isset($item['description'])
                    <p class="mt-6 text-slate-700 leading-8">{{ $item['description'] }}</p>
                @endisset

                @isset($item['body'])
                    <div class="prose prose-slate mt-6 max-w-none leading-8 text-slate-700">
                        {!! $item['body'] !!}
                    </div>
                @endisset
            </div>
             @if(!empty($item['images'] ?? []))
                <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($item['images'] as $galleryImage)
                        <button type="button" class="gallery-lightbox-trigger overflow-hidden rounded-2xl bg-slate-100 shadow-sm ring-1 ring-slate-200 focus:outline-none focus:ring-2 focus:ring-[#ff9700]" data-images='@json($item['images'])' data-index="{{ $loop->index }}" aria-label="Afficher {{ $item['name'] ?? $item['title'] }}">
                            <img src="{{ $galleryImage }}" alt="{{ $item['name'] ?? $item['title'] }}" class="h-56 w-full object-cover transition duration-300 hover:scale-105" loading="lazy">
                        </button>
                    @endforeach
                </div>
            @endif

            <div class="mt-8 space-y-5 text-slate-700">
                @isset($item['requirements'])
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Prerequis</h2>
                        <p class="mt-2 leading-7">{{ $item['requirements'] }}</p>
                    </div>
                @endisset

                @isset($item['objectives'])
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Objectifs</h2>
                        <p class="mt-2 leading-7">{{ $item['objectives'] }}</p>
                    </div>
                @endisset
            </div>

            @if(!empty($item['fichier']))
                        <?php 
$url = $item['fichier'];

// Récupère la partie JSON
$json = substr($url, strpos($url, '['));

$data = json_decode($json, true);

$downloadLink = $data[0]['download_link'];
 
$file_path =  asset('storage/'.$downloadLink);
    ?>


                <div class="mt-8">
                    <h2 class="text-lg font-semibold text-slate-900">Document joint</h2>
                    <div id="pdf-viewer" class="mt-4 overflow-hidden rounded-xl ring-1 ring-slate-200 shadow-sm" data-url="{{ $item['fichier'] }}">
                        <embed src="<?php echo $file_path; ?>" width="100%" height="800" type="application/pdf" />
                    </div>
                    <a href="{{ $file_path }}" target="_blank" download class="mt-4 inline-flex items-center gap-2 rounded-md bg-[#00498f] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#003870]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Télécharger le communiqué
                    </a>
                </div>
            @endif

            <a href="{{ $backRoute }}" class="mt-8 inline-flex items-center justify-center rounded-md border border-[#00498f] px-5 py-3 text-sm font-bold uppercase text-[rgb(37_90_48)] hover:bg-[#00498f] hover:text-white">
                Retour
            </a>
        </article>

        @if(!empty($item['images'] ?? []))
            <div id="gallery-lightbox" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/90 p-4" role="dialog" aria-modal="true">
                <button type="button" id="gallery-lightbox-close" class="absolute right-5 top-5 inline-flex h-11 w-11 items-center justify-center rounded-full bg-white text-2xl font-bold text-slate-900 hover:bg-slate-100" aria-label="Fermer">
                    &times;
                </button>
                <button type="button" id="gallery-lightbox-prev" class="absolute left-5 top-1/2 inline-flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-3xl font-bold text-slate-900 hover:bg-white" aria-label="Image précédente">
                    &lsaquo;
                </button>
                <img id="gallery-lightbox-image" src="" alt="Image galerie" class="max-h-[86vh] max-w-[92vw] rounded-xl object-contain shadow-2xl">
                <button type="button" id="gallery-lightbox-next" class="absolute right-5 top-1/2 inline-flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-3xl font-bold text-slate-900 hover:bg-white" aria-label="Image suivante">
                    &rsaquo;
                </button>
            </div>
        @endif
    </div>
@endsection

@if(!empty($item['fichier']))
@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ asset('js/jquery.gdocsviewer.min.js') }}"></script>
<script>
   $(document).ready(function() {
    $('a.embed').gdocsViewer();
});
</script>
@endpush
@endif
