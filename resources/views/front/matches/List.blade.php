<div class="max-w-screen-lg mx-auto pt-4">
    <div style="min-height: calc(100vh - 56px - 78px);" class="md:p-0 p-2">
        <div class="flex justify-between mb-6 items-center">
            <div class="px-2 py-1 rounded hover:bg-gray-300 border cursor-pointer">
                <a href="/matches?date={{ $query['date'] }}&act=prev">Prev</a>
            </div>
            <div class="text-sm font-medium border-b border-red-400">{{ date('d M Y', strtotime($query['date'])) }}</div>
            <div class="px-2 py-1 rounded hover:bg-gray-300 border cursor-pointer">
                <a href="/matches?date={{ $query['date'] }}&act=next"> Next </a>
            </div>
        </div>
        @foreach ($match_types as $match_type)
            @if (isset($match_type->matches))
                @if (count($match_type->matches) > 0)
                    <div class="mb-6">
                        <div class="text-lg font-medium leading-4 border-l border-red-700 ps-2 mt-2 mb-3">
                            {{ $match_type->name }}
                        </div>
                        <div class="grid md:grid-cols-3 grid-cols-1 gap-2">
                            @foreach ($match_type->matches as $match)
                                @include('front.components.MatchResult')
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
        @endforeach
    </div>
</div>
