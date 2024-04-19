<div class="pl-2 pr-2 pb-2 border rounded-md">
    <div class="pt-0 text-sm">
        <div class="flex mb-2">
            <div class="grow"></div>
            @if (isset($match->match_type))
                <div
                    class="
                    @switch($match->match_type->name)
                        @case('Tunggal Putra')
                        bg-blue-500
                        @break 
                        @case('Tunggal Putri')
                        bg-fuchsia-500
                        @break 
                        @case('Ganda Putra')
                        bg-cyan-500
                        @break 
                        @default
                        bg-pink-500
                    @endswitch 
                    px-3 rounded-br-md rounded-bl-md">
                    <span class="text-white font-medium text-xs">
                        {{ $match->match_type->name }}
                    </span>
                </div>
            @endif
            <div class="grow"></div>
        </div>

        <div class="flex justify-between mb-2 text-slate-600">
            <div class="font-medium">
                {{ $match->competition_name }}
            </div>
            @if (isset($match->round_category))
                <div
                    class="font-medium  
            @switch($match->round_category->name)
                @case('Final')
                text-emerald-900
                @break 
                @case('Semi FInal')
                text-emerald-700
                @break 
                @case('Quarter Final')
                text-emerald-500
                @break 
                @default
                text-emerald-400
            @endswitch ">
                    {{ $match->round_category->name }}
                </div>
            @endif
        </div>
        <table class="w-full">
            <tbody>
                @if (isset($match->home_first_player))
                    <tr>
                        <td class="flex">
                            <div class="w-10" title="{{ $match->home_first_player->city }}">
                                {{ $match->home_first_player->city_init }}
                            </div>
                            <div title="{{ $match->home_first_player->full_name }}">
                                <a @if (isset($match->match_detail) && $match->match_detail->final_home_points > $match->match_detail->final_away_points) class="font-semibold" 
                                  @else class="" @endif
                                    href="/matches/{{ $match->home_first_player->id }}-{{ str_to_link($match->home_first_player->full_name) }}">
                                    {{ strtoupper($match->home_first_player->full_name) }}
                                </a>
                            </div>
                        </td>
                        <td class="text-right" @if (isset($match->home_second_player)) rowspan="2" @endif>
                            <div
                                @if (isset($match->match_detail) && $match->match_detail->final_home_points > $match->match_detail->final_away_points) class="flex font-semibold" 
                              @else class="flex" @endif>
                                @if (isset($match->match_detail))
                                    @if ($match->match_detail->first_home_points !== null)
                                        <div class="w-7 text-center grow">
                                            {{ $match->match_detail->first_home_points }}
                                            @if ($match->match_detail->is_first_tie_break)
                                                <sup>{{ $match->match_detail->first_home_tie_break_points }}</sup>
                                            @endif
                                        </div>
                                    @endif
                                    @if ($match->match_detail->second_home_points !== null)
                                        <div class="w-7 text-center grow">
                                            {{ $match->match_detail->second_home_points }}
                                            @if ($match->match_detail->is_second_tie_break)
                                                <sup>{{ $match->match_detail->second_home_tie_break_points }}</sup>
                                            @endif
                                        </div>
                                    @endif
                                    @if ($match->match_detail->third_home_points !== null)
                                        <div class="w-7 text-center grow">
                                            {{ $match->match_detail->third_home_points }}
                                            @if ($match->match_detail->is_third_tie_break)
                                                <sup>{{ $match->match_detail->third_home_tie_break_points }}</sup>
                                            @endif
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                @endif

                @if (isset($match->home_second_player))
                    <tr>
                        <td class="flex">
                            <div class="w-10" title="{{ $match->home_second_player->city }}">
                                {{ $match->home_second_player->city_init }}
                            </div>
                            <div title="{{ $match->home_second_player->full_name }}">
                                <a @if (isset($match->match_detail) && $match->match_detail->final_home_points > $match->match_detail->final_away_points) class="font-semibold" 
                                  @else class="" @endif
                                    href="/matches/{{ $match->home_second_player->id }}-{{ str_to_link($match->home_second_player->full_name) }}">
                                    {{ $match->home_second_player->full_name }}
                                </a>
                            </div>
                        </td>
                    </tr>
                @endif

                @if (isset($match->away_first_player))
                    <tr>
                        <td class="flex border-t">
                            <div class="w-10" title="{{ $match->away_first_player->city }}">
                                {{ $match->away_first_player->city_init }}
                            </div>
                            <div title="{{ $match->away_first_player->full_name }}">
                                <a @if (isset($match->match_detail) && $match->match_detail->final_away_points > $match->match_detail->final_home_points) class="font-semibold" 
                                  @else class="" @endif
                                    href="/matches/{{ $match->away_first_player->id }}-{{ str_to_link($match->away_first_player->full_name) }}">
                                    {{ $match->away_first_player->full_name }}
                                </a>
                            </div>
                        </td>
                        <td class="text-right border-t" @if (isset($match->away_second_player)) rowspan="2" @endif>
                            <div
                                @if (isset($match->match_detail) && $match->match_detail->final_away_points > $match->match_detail->final_home_points) class="flex font-semibold" 
                              @else class="flex" @endif>
                                @if (isset($match->match_detail))
                                    @if ($match->match_detail->first_away_points !== null)
                                        <div class="w-6 text-center grow">
                                            {{ $match->match_detail->first_away_points }}
                                            @if ($match->match_detail->is_first_tie_break)
                                                <sup>{{ $match->match_detail->first_away_tie_break_points }}</sup>
                                            @endif
                                        </div>
                                    @endif
                                    @if ($match->match_detail->second_away_points !== null)
                                        <div class="w-6 text-center grow">
                                            {{ $match->match_detail->second_away_points }}
                                            @if ($match->match_detail->is_second_tie_break)
                                                <sup>{{ $match->match_detail->second_away_tie_break_points }}</sup>
                                            @endif
                                        </div>
                                    @endif
                                    @if ($match->match_detail->third_away_points !== null)
                                        <div class="w-7 text-center grow">
                                            {{ $match->match_detail->third_away_points }}
                                            @if ($match->match_detail->is_third_tie_break)
                                                <sup>{{ $match->match_detail->third_away_tie_break_points }}</sup>
                                            @endif
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                @endif
                @if (isset($match->away_second_player))
                    <tr>
                        <td class="flex">
                            <div class="w-10" title="{{ $match->away_second_player->city }}">
                                {{ $match->away_second_player->city_init }}
                            </div>
                            <div title="{{ $match->away_second_player->full_name }}">
                                <a @if (isset($match->match_detail) && $match->match_detail->final_away_points > $match->match_detail->final_home_points) class="font-semibold" 
                                  @else class="" @endif
                                    href="/matches/{{ $match->away_second_player->id }}-{{ str_to_link($match->away_second_player->full_name) }}">
                                    {{ $match->away_second_player->full_name }}
                                </a>
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="text-right text-xs italic">
            {{ date('d M Y', strtotime($match->date)) }}
        </div>
    </div>
</div>
