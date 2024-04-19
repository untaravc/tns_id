<div class="max-w-screen-lg mx-auto pt-4">
    <div style="min-height: calc(100vh - 56px - 78px);" class="md:p-0 p-2">
        @foreach ($competitions as $competition)
            <div class="mb-10">
                <div class="text-lg font-medium leading-4 border-l border-red-700 ps-2 mt-2 mb-3">
                    {{ $competition->name }}
                </div>
                <div class="grid md:grid-cols-3 grid-cols-1 gap-2">
                    @if (isset($competition->matches))
                        @foreach ($competition->matches as $match)
                            @include('front.components.MatchResult')
                        @endforeach
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
