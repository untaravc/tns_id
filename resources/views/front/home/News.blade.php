<div class="max-w-screen-lg mx-auto" style="height: calc(100vh - 56px - 78px); margin-top: 10px">
    <div class="grid grid-cols-4 gap-2">
        <div class="lg:col-span-1 lg:row-span-3 col-span-4 bg-slate-50 rounded-md p-3 pb-0">
            <div class="text-sm font-semibold">Pertandingan</div>
            @for ($i = 0; $i < 3; $i++)
                <div class="pt-2 text-xs border-b-2 mb-2">
                    <div class="t font-semibold">
                        Tunamen Armada XXI 2024
                    </div>
                    <div class="flex justify-between mb-2 text-slate-600">
                        <div>22/3/24</div>
                        <div>
                            Final - Ganda Putra
                        </div>
                    </div>
                    <table class="w-full">
                        <tr>
                            <td class="flex">
                                <div class="w-8">JKT</div>
                                <div class="font-semibold">{{ truncate('Wulandari Bustomi Azes') }}</div>
                            </td>
                            <td class="text-right font-semibold">2 6 8</td>
                        </tr>
                        <tr>
                            <td class="flex">
                                <div class="w-8">DIY</div>
                                <div class="font-semibold">{{ truncate('Sampurasun') }}</div>
                            </td>
                            <td class="text-right font-semibold">1 3 2</td>
                        </tr>
                    </table>
                </div>
            @endfor
        </div>
        <div class="lg:col-span-2 lg:row-span-3 col-span-4">
            <div class="h-full bg-slate-50 bg-center bg-cover rounded-md"
                style="background-image: url('/assets/images/tenis.jpeg')">

            </div>
            <div class="absolute bottom-0 p-3">
                <div class="text-lg font-semibold text-slate-50">SWIATEK ROLLS IN COLLINS REMATCH</div>
                <div class="text-md text-slate-100">The 2022 Indian Wells champ applied lessons learned from a tough
                    Aussie Open clash.</div>
            </div>
        </div>
        @for ($i = 0; $i < 3; $i++)
            <div class="lg:col-span-1 col-span-2 bg-slate-50 rounded-md p-3 flex justify-between">
                <div class="text-sm w-2/3">
                    {{ truncate('The 2022 Indian Wells champ applied lessons learned from a tough', 60) }}
                </div>
                <div class="w-1/3 aspect-square bg-center bg-cover rounded-md"
                    style="background-image: url('/assets/images/tenis.jpeg')">
                </div>
            </div>
        @endfor
    </div>
</div>
