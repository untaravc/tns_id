<div class="max-w-screen-lg mx-auto pt-4">
    <div style="min-height: calc(100vh - 56px - 78px);" class="md:p-0 p-2">
        @foreach ($competitions as $competition)
            <div class="mb-6">
                <div class="text-lg font-medium leading-4 border-l border-red-700 ps-2 mt-2 mb-3">
                    {{ $competition->name }}
                </div>
                <div class="grid md:grid-cols-3 grid-cols-1 gap-2">
                    @if (isset($competition->matches))
                        @foreach ($competition->matches as $match)
                            <div class="p-2 border rounded-md">
                                <div class="pt-2 text-xs">
                                    <div class="t font-medium">
                                        @if (isset($match->match_type))
                                            {{ $match->match_type->name }}
                                        @else
                                            <span class="text-transparent">.</span>
                                        @endif
                                    </div>
                                    <div class="flex justify-between mb-2 text-slate-600">
                                        <div>
                                            {{ date('d M Y', strtotime($match->date)) }}
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
                                                                {{ $match->home_first_player->full_name }}
                                                            </a>
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
                                                        @if ($match->match_detail->third_home_points !== null)
                                                            <span>
                                                                {{ $match->match_detail->third_home_points }}
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
                                                                href="/matches/{{ $match->away_first_player->id }}-{{ str_to_link($match->away_first_player->full_name) }}">
                                                                {{ $match->away_first_player->full_name }}
                                                            </a>
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
                                                        @if ($match->match_detail->third_away_points !== null)
                                                            <span>
                                                                {{ $match->match_detail->third_away_points }}
                                                            </span>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
        @endforeach
    </div>
</div>
