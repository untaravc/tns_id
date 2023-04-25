<div class="max-w-screen-lg mx-auto p-3 mt-6">
    {{--    <div class="bg-blue-600 py-3 px-5 text-white font-bold rounded-tr-xl inline-block min-w-[100px]">News</div>--}}
    {{--    <div class="border-b-blue-600 border-b-4 w-full"></div>--}}
    <div class="text-2xl border-b-4 border-red-700 inline-block font-bold">BERITA</div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 mt-3">
        <div class="row-span-2 col-span-2 md:col-span-2 md:row-span-2">
            <div class="h-56 bg-center bg-no-repeat rounded-sm bg-cover"
                 style="background-image: url('/assets/img/bg-169-book.jpeg')"></div>
            <div class="p-2">
                <div class="flex justify-between">
                    <div class="text-sm bg-slate-800 px-3 rounded text-white">Kategori</div>
                    <div class="text-sm italic">3 Jun</div>
                </div>
                <div class="font-medium text-xl">
                    Klasemen Pemain Tenis Indonesia
                </div>
                <div class="text-base">
                    What's possible in a week? If you dedicated seven days to the achievement of one goal, how ambitious
                    could you make this goal? These
                </div>
            </div>
        </div>
        @for($i = 1; $i<5; $i++)
            <div>
                <div class="h-24 bg-center bg-no-repeat rounded-sm bg-cover"
                     style="background-image: url('/assets/img/bg-169-fur.jpeg')"></div>
                <div class="p-2">
                    <div class="font-bold">Klasemen Pemain Tenis Indonesia</div>
                </div>
            </div>
        @endfor
    </div>
</div>
