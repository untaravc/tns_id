<div class="max-w-screen-lg mx-auto pt-4">
    <div style="min-height: calc(100vh - 56px - 78px - 188px);" class="md:p-0 p-2">
        <form>
            <div class="flex">
                <div class="grow px-1">
                    <label for="player_category_code" class="block mb-2 text-sm font-medium text-gray-900">Pemain</label>
                    <select id="player_category_code" name="player_category_code"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        @foreach ($player_categories as $category)
                            <option value="{{ $category->code }}" @if (request('player_category_code') == $category->code) selected @endif>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grow px-1">
                    <label for="match_type_category_id"
                        class="block mb-2 text-sm font-medium text-gray-900">Pertandingan</label>
                    <select id="match_type_category_id" name="match_type_category_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        @foreach ($match_type as $type)
                            <option value="{{ $type->id }}" @if (request('match_type_category_id') == $type->id) selected @endif>
                                {{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="">
                    <label class="block mb-2 text-sm font-medium text-transparent" for="">.</label>
                    <button type="submit"
                        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Cari..</button>
                </div>
            </div>
        </form>
        <div class="md:text-2xl tex-xl mb-2">
            @if ($match_count == 0)
                <div class="italic text-center text-slate-400 text-lg">Belum ada data pertandingan</div>
            @endif
            @foreach ($rounds as $round)
                @if (count($round['matches']) > 0)
                    <div class="mb-6">
                        <div class="text-lg font-medium leading-4 border-l border-red-700 ps-2 mt-2 mb-3">
                            {{ $round['name'] }}
                        </div>
                        <div class="grid md:grid-cols-3 grid-cols-1 gap-2">
                            @foreach ($round['matches'] as $match)
                                @include('front.components.MatchResult')
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
