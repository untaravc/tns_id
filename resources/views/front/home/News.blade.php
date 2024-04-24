<div class="max-w-screen-lg mx-auto pt-4">
    <div style="min-height: calc(100vh - 56px - 78px);" class="md:p-0 p-2">
        <div class="grid grid-cols-4 gap-2 mb-5">
            <div class="md:col-span-1 md:row-span-3 col-span-4 row-span-1 rounded-md p-3 shadow-md">
                <div class="text-sm font-semibold">Pertandingan</div>
                @foreach ($matches as $match)
                    <div class="pt-2 text-xs border-b-2 mb-2">
                        <div class="t font-medium">
                            @if ($match->competition)
                                {{ $match->competition->name }}
                            @endif
                        </div>
                        <div class="flex justify-between mb-2 text-slate-600">
                            <div>
                                {{ date('d/m/y', strtotime($match->date)) }}
                            </div>
                            <div>
                                @if ($match->round_category)
                                    {{ $match->round_category->name }}
                                @endif
                                @if ($match->match_type)
                                    - {{ $match->match_type->name }}
                                @endif
                            </div>
                        </div>
                        <table class="w-full">
                            <tr>
                                <td class="flex">
                                    @if ($match->home_first_player)
                                        <div class="w-8" title="{{ $match->home_first_player->city }}">
                                            {{ truncate_str($match->home_first_player->city_init) }}
                                        </div>
                                        <div class="font-medium" title="{{ $match->home_first_player->full_name }}">
                                            <a
                                                href="/matches/{{ $match->home_first_player->id }}-{{ str_to_link($match->home_first_player->full_name) }}">
                                                {{ truncate_str($match->home_first_player->full_name) }}
                                            </a>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-right">
                                    @if ($match->match_detail)
                                        @if ($match->match_detail->first_home_points > -1)
                                            <span @if ($match->match_detail->first_home_points > $match->match_detail->first_away_points) class="font-medium" @endif>
                                                {{ $match->match_detail->first_home_points }}
                                            </span>
                                        @endif
                                        @if ($match->match_detail->second_home_points > -1)
                                            <span @if ($match->match_detail->second_home_points > $match->match_detail->second_away_points) class="font-medium" @endif>
                                                {{ $match->match_detail->second_home_points }}
                                            </span>
                                        @endif
                                        @if ($match->match_detail->third_home_points > -1)
                                            <span @if ($match->match_detail->third_home_points > $match->match_detail->third_away_points) class="font-medium" @endif>
                                                {{ $match->match_detail->third_home_points }}
                                            </span>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="flex">
                                    @if ($match->away_first_player)
                                        <div class="w-8" title="{{ $match->away_first_player->city }}">
                                            {{ truncate_str($match->away_first_player->city_init) }}
                                        </div>
                                        <div class="font-medium" title="{{ $match->away_first_player->full_name }}">
                                            <a
                                                href="/matches/{{ $match->away_first_player->id }}-{{ str_to_link($match->away_first_player->full_name) }}">
                                                {{ truncate_str($match->away_first_player->full_name) }}
                                            </a>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-right">
                                    @if ($match->match_detail)
                                        @if ($match->match_detail->first_away_points > -1)
                                            <span @if ($match->match_detail->first_away_points > $match->match_detail->first_home_points) class="font-medium" @endif>
                                                {{ $match->match_detail->first_away_points ?? '0' }}
                                            </span>
                                        @endif
                                        @if ($match->match_detail->second_away_points > -1)
                                            <span @if ($match->match_detail->second_away_points > $match->match_detail->second_home_points) class="font-medium" @endif>
                                                {{ $match->match_detail->second_away_points ?? '0' }}
                                            </span>
                                        @endif
                                        @if ($match->match_detail->third_away_points > -1)
                                            <span @if ($match->match_detail->third_away_points > $match->match_detail->third_home_points) class="font-medium" @endif>
                                                {{ $match->match_detail->third_away_points ?? '0' }}
                                            </span>
                                        @endif
                                    @endif
                                </td>
                            </tr>

                        </table>
                    </div>
                @endforeach
                <div class="text-center text-xs text-blue-700 hover:text-blue-500 underline">
                    <a href="/matches">Selengkapnya</a>
                </div>
            </div>
            <div class="md:col-span-2 md:row-span-3 md:h-auto h-64 col-span-4 row-span-1 relative">
                <a
                    @if ($news_head->is_affiliate) href="{{ $news_head->resource_url }}" @else href="/posts/{{ $news_head->id }}-{{ str_to_link($news_head->title) }}" @endif>
                    <div class="h-full bg-slate-50 bg-center bg-cover rounded-md"
                        style="background-image: url('@if ($news_head->image) {{ $news_head->image }}
@else
{{ $news_head->image_url }} @endif')">
                    </div>
                    <div class="absolute bottom-0 p-3 bg-opacity-50 bg-slate-700">
                        @if ($news_head->resource)
                            <img src="{{ $news_head->resource->image }}" alt="{{ $news_head->resource->name }}"
                                style="height: 20px">
                        @endif
                        <div class="text-lg font-semibold text-slate-50">{{ $news_head->title }}</div>
                    </div>
                </a>
            </div>
            @foreach ($news as $new)
                <a @if ($new->is_affiliate) href="{{ $new->resource_url }}" @else href="/posts/{{ $new->id }}-{{ str_to_link($new->title) }}" @endif
                    class="md:col-span-1 md:h-auto h-32 row-span-1 col-span-4 shadow-md rounded-md p-3 flex justify-between">
                    <div class="text-sm w-2/3">
                        @if ($new->resource)
                            <img src="{{ $new->resource->image }}" alt="{{ $new->resource->name }}"
                                style="height: 20px">
                        @endif
                        <div class="font-medium">{{ truncate_str($new->title, 40) }}</div>
                        <div class="text-xs italic text-slate-500">
                            {{ date('d/m/y', strtotime($new->created_at)) }}
                        </div>
                    </div>
                    <div class="w-1/3 aspect-square bg-center bg-cover rounded-md"
                        style="background-image: url('@if ($new->image) {{ $new->image }} @else {{ $new->image_url }} @endif')">
                    </div>
                </a>
            @endforeach
        </div>
        <div class="grid grid-cols-3 gap-2">
            <div class="md:col-span-1 col-span-3">
                <div class="text-lg font-normal leading-4 border-l border-red-700 ps-2">
                    Turnamen
                </div>
                <div class="grid grid-cols-1 gap-2 mt-3 text-sm">
                    @foreach ($competitions as $competition)
                        <a href="/competitions/{{ $competition->id }}-{{ str_to_link($competition->name) }}">
                            <div class="flex p-2">
                                <div class="w-1/6 aspect-square bg-center bg-cover rounded-md"
                                    style="background-image: url('{{ $competition->image }}')">
                                </div>
                                <div class="ps-3">
                                    <div>{{ $competition->name }}</div>
                                    <div class="text-xs">{{ $competition->address }},
                                        {{ date('d M Y', strtotime($competition->date_start)) }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="md:col-span-1 col-span-3">
                <div class="text-lg font-normal leading-4 border-l border-red-700 ps-2">
                    Putra
                </div>
                <div class="grid grid-cols-1 gap-2 mt-3 text-sm">
                    @foreach ($male_players as $male)
                        <a href="/matches/{{ $male->id }}-{{ str_to_link($male->name) }}">
                            <div class="p-2 border-gray-200 border-b bg-white">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <img class="rounded-full w-9 h-9" alt="pic" src="{{ $male->image }}">
                                        <div class="ml-2">
                                            <div class="font-medium">{{ truncate_str($male->full_name, 20) }}</div>
                                            <div class="italic text-xs">{{ $male->city }}</div>
                                        </div>
                                    </div>
                                    <div class="italic">
                                        <span class="font-bold">0 </span><span class="text-xm">pts</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    <div class="text-center text-xs text-blue-700 hover:text-blue-500 underline">
                        <a href="/players?gender=M">Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="md:col-span-1 col-span-3">
                <div class="text-lg font-normal leading-4 border-l border-red-700 ps-2">
                    Putri
                </div>
                <div class="grid grid-cols-1 gap-2 mt-3 text-sm">
                    @foreach ($female_players as $female)
                        <a href="/matches/{{ $female->id }}-{{ str_to_link($female->name) }}">
                            <div class="p-2 border-gray-200 border-b bg-white">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <img class="rounded-full w-9 h-9" alt="pic" src="{{ $female->image }}">
                                        <div class="ml-2">
                                            <div class="font-medium">{{ truncate_str($female->full_name, 20) }}</div>
                                            <div class="italic text-xs">{{ $female->city }}</div>
                                        </div>
                                    </div>
                                    <div class="italic">
                                        <span class="font-bold">0 </span><span class="text-xm">pts</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    <div class="text-center text-xs text-blue-700 hover:text-blue-500 underline">
                        <a href="/players?gender=F">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
