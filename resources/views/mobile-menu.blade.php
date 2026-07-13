@foreach ($items as $item)
    @php
        $url = $item->link();
        $https = '~https://~';
        $http = '~http://~';

        if ((!(preg_match($http, $url))) && (!(preg_match($https, $url))) && $url !== '#') {
            $url = url($url);
        }

        $hasChildren = $item->children->isNotEmpty();
    @endphp

    @if (! $hasChildren)
        <a href="{{ $url }}" class="block rounded-xl px-4 py-3 text-sm text-[rgb(37_90_48)] hover:bg-slate-100" @if(!empty($item->target)) target="{{ $item->target }}" @endif>
            {{ $item->title }}
        </a>
    @else
        <div class="space-y-1">
            <a href="{{ $url }}" class="block rounded-xl px-4 py-3 text-sm font-semibold text-[rgb(37_90_48)] hover:bg-slate-100" @if(!empty($item->target)) target="{{ $item->target }}" @endif>
                {{ $item->title }}
            </a>
            <div class="space-y-1 px-4">
                @foreach ($item->children as $child)
                    @php
                        $childUrl = $child->link();

                        if ((!(preg_match($http, $childUrl))) && (!(preg_match($https, $childUrl))) && $childUrl !== '#') {
                            $childUrl = url($childUrl);
                        }
                    @endphp

                    <a href="{{ $childUrl }}" class="block rounded-lg px-4 py-2 text-sm text-[rgb(37_90_48)] hover:bg-slate-100 hover:text-[#ff9700]" @if(!empty($child->target)) target="{{ $child->target }}" @endif>
                        {{ $child->title }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif
@endforeach
