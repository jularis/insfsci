@if($flashInfos->isNotEmpty())

    <section class="mt-10">
        <div class="rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
            <div class="flex items-center gap-8">
                <div class="flex-shrink-0 min-w-max">
                    <h2 class="text-3xl font-bold text-slate-900">Flash Infos</h2>
                </div>

                <div class="flex-1 relative overflow-hidden" id="flashInfosContainer">
                    <div class="flash-infos-carousel flash-infos-track flex gap-4" id="flashInfosCarousel">
                        @foreach($flashInfos as $info)
                            <div class="flex-shrink-0 w-[calc(50%-0.5rem)] min-w-[calc(50%-0.5rem)] rounded-2xl bg-gradient-to-br from-red-50 to-red-100 p-6 ring-1 ring-red-200">
                                <a href="{{ filled($info->slug) ? url($info->slug) : route('communiques') }}" class="block text-slate-700 leading-6 transition hover:text-red-700 focus:text-red-700 focus:outline-none">
                                    {{ $info->content }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
