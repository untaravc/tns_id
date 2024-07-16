<div class="max-w-screen-lg mx-auto pt-4">
    <div style="min-height: calc(100vh - 56px - 78px - 188px);" class="md:p-0 p-2">
        <form>
            <div class="flex mb-3">
                <div class="grow px-1">
                    <label for="player_category_code"
                        class="block mb-2 text-sm font-medium text-gray-900">Kategori</label>
                    <select id="player_category_code" name="player_category_code"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="">Semua</option>
                        @foreach ($player_categories as $category)
                            <option value="{{ $category->code }}" @if (request('player_category_code') == $category->code) selected @endif>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grow px-1">
                    <label for="match_type_category_id"
                        class="block mb-2 text-sm font-medium text-gray-900">Pemain</label>
                    <select id="match_type_category_id" name="gender"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="">Semua</option>
                        <option value="F" @if (request('gender') == 'F') selected @endif>Putri</option>
                        <option value="M" @if (request('gender') == 'M') selected @endif>Putra</option>
                    </select>
                </div>
                <div class="">
                    <label class="block mb-2 text-sm font-medium text-transparent" for="">.</label>
                    <button type="submit"
                        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Cari..</button>
                </div>
            </div>
        </form>
        <div>
            <table class="w-full text-left text-sm">
                <tr>
                    <th class="px-3 border-b-2"></th>
                    <th class="px-3 border-b-2">
                        <b>Nama</b>
                    </th>
                    <th class="px-3 border-b-2">Kategori</th>
                    <th class="px-3 border-b-2">Kelompok</th>
                    <th class="px-3 border-b-2">Poin</th>
                </tr>
                @if (count($players) == 0)
                    <tr>
                        <td colspan="5" class="italic text-center text-slate-400 px-3 py-2 border-b">
                            Tidak ada data
                        </td>
                    </tr>
                @endif
                @foreach ($players as $player)
                    <tr>
                        <td class="px-3 py-2 border-b w-10">
                            <div class="h-10 w-10 bg-top rounded-full border bg-contain"
                                style="background-image: url('{{ $player->image }}')" alt="">
                        </td>
                        <td class="px-3 py-2 border-b">
                            <a class="font-medium text-blue-900 hover:text-blue-600"
                                href="/matches/{{ $player->player_id }}-{{ str_to_link($player->player_name) }}">
                                {{ $player->player_name }}
                            </a>
                        </td>
                        <td class="px-3 py-2 border-b">
                            @if ($player->player_gender == 'M')
                                Putra
                            @else
                                Putri
                            @endif
                        </td>
                        <td class="px-3 py-2 border-b">
                            {{ $player->player_category_code }}
                        </td>
                        <td class="px-3 py-2 border-b">
                            {{ round($player->points * 100) / 100 }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
