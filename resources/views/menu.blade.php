@foreach ($items as $item)
    @php
        $originalItem = $item;

        $url = $item->link();
        $https = '~https://~';
        $http = '~http://~';

        if ((!(preg_match($http, $url))) && (!(preg_match($https, $url)))) {
            $url = url($item->link());
        }

        $hasChildren = !$originalItem->children->isEmpty();

        $widthClass = 'w-60';
        $titleKey = Str::slug($item->title);

        if (Str::contains($titleKey, 'etablissements')) {
            $widthClass = 'w-64';
        } elseif (Str::contains($titleKey, 'services')) {
            $widthClass = 'w-72';
        } elseif (Str::contains($titleKey, 'galerie')) {
            $widthClass = 'w-52';
        } elseif (Str::contains($titleKey, 'institut')) {
            $widthClass = 'w-60';
        }

    @endphp

    @if (!$hasChildren)
        <a href="{{ $url }}" class="transition hover:text-[#ff9700]" @if(!empty($item->target)) target="{{ $item->target }}" @endif>
            {{ $item->title }}
        </a>
    @else
        <div class="relative group">
            <button class="inline-flex items-center gap-1 transition hover:text-[#ff9700]" type="button">
                {{ $item->title }}
                <span aria-hidden="true">▾</span>
            </button>

            <div class="invisible absolute left-0 top-full z-50 mt-2 {{ $widthClass }} rounded-md border border-slate-200 bg-white py-2 opacity-0 shadow-lg transition-all duration-200 group-hover:visible group-hover:opacity-100">
                @foreach ($originalItem->children as $child)
                    @php
                        $childUrl = $child->link();

                        if ((!(preg_match($http, $childUrl))) && (!(preg_match($https, $childUrl))) && $childUrl !== '#') {
                            $childUrl = url($childUrl);
                        }
                    @endphp

                    <a href="{{ $childUrl }}" class="block px-4 py-2 text-sm text-[rgb(37_90_48)] hover:bg-slate-50 hover:text-[#ff9700]" @if(!empty($child->target)) target="{{ $child->target }}" @endif>
                        {{ $child->title }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif
@endforeach
