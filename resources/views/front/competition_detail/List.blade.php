<div class="max-w-screen-lg mx-auto pt-4">
    <div style="min-height: calc(100vh - 56px - 78px - 188px);" class="md:p-0 p-2">
        <div class="md:text-2xl tex-xl mb-2">
            @foreach($match_type as $type)
                <div class="text-center border-b border-red-800 text-lg text-blue-700 font-bold">
                    {{$type->name}}
                </div>
                @foreach($type['rounds'] as $round)
                    @if(count($round['matches']) > 0)
                        <div class="mb-6">
                            <div class="text-lg font-medium leading-4 border-l border-red-700 ps-2 mt-2 mb-3">
                                {{$round['name']}}
                            </div>
                            <div class="grid md:grid-cols-3 grid-cols-1 gap-2">
                                @foreach ($round['matches'] as $match)
                                    <div class="p-2 border rounded-md">
                                        <div class="pt-2 text-xs">
                                            <div class="t font-medium">
                                                {{ $match->competition_name }}
                                            </div>
                                            <div class="flex justify-between mb-2 text-slate-600">
                                                <div>
                                                    {{ date('m/d/Y', strtotime($match->date)) }}
                                                </div>
                                                <div>
                                                    @if (isset($match->round_category))
                                                        {{ $match->round_category->name }}
                                                    @endif
                                                </div>
                                            </div>
                                            <table class="w-full">
                                                <tbody>
                                                    <tr>
                                                        <td class="flex">
                                                            <div class="w-10" title="SOLO">
                                                                @if (isset($match->home_first_player))
                                                                    {{ $match->home_first_player->city_init }}
                                                                @endif
                                                            </div>
                                                            <div class="font-medium" title="SAAFIA devani putri">
                                                                @if (isset($match->home_first_player))
                                                                    <a
                                                                        href="/matches/{{ $match->home_first_player->id }}-{{ str_to_link($match->home_first_player->full_name) }}">
                                                                        {{ $match->home_first_player->full_name }}</a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            @if (isset($match->match_detail))
                                                                @if ($match->match_detail->first_home_points !== null)
                                                                    <span>
                                                                        {{ $match->match_detail->first_home_points }}
                                                                    </span>
                                                                @endif
                                                                @if ($match->match_detail->second_home_points !== null)
                                                                    <span>
                                                                        {{ $match->match_detail->second_home_points }}
                                                                    </span>
                                                                @endif
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="flex">
                                                            <div class="w-10" title="SOLO">
                                                                @if (isset($match->away_first_player))
                                                                    {{ $match->away_first_player->city_init }}
                                                                @endif
                                                            </div>
                                                            <div class="font-medium" title="SAAFIA devani putri">
                                                                @if (isset($match->away_first_player))
                                                                    <a
                                                                        href="/matches/{{ $match->away_first_player->id }}-{{ str_to_link($match->away_first_player->full_name) }}">{{ $match->away_first_player->full_name }}</a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            @if (isset($match->match_detail))
                                                                @if ($match->match_detail->first_away_points !== null)
                                                                    <span>
                                                                        {{ $match->match_detail->first_away_points }}
                                                                    </span>
                                                                @endif
                                                                @if ($match->match_detail->second_away_points !== null)
                                                                    <span>
                                                                        {{ $match->match_detail->second_away_points }}
                                                                    </span>
                                                                @endif
                                                            
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            @endforeach
        </div>
    </div>
</div>