<div class="max-w-screen-lg mx-auto p-3">
    <div class="bg-cyan-800 py-3 px-5 text-white font-bold inline-block">Turnamen</div>
    <div class="border-b-cyan-800 border-b-4 w-full"></div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mt-3">
        @for($i = 1; $i < 4; $i++)
            <div class="h-56 relative bg-center bg-no-repeat rounded bg-cover bg-[url('/assets/img/bg-169-mov.jpeg')]">
                <div class="absolute right-2 top-2 bg-white px-3 rounded text-sm flex">
                    <div>29 Nov</div>
                </div>
                <div
                    class="absolute bottom-0 left-0  bg-opacity-50 rounded-bl rounded-br bg-black pt-2 pb-4 right-0 px-3">
                    <div class="border-gray-200 inline-block border rounded-full px-2 text-sm text-gray-200">Jawa Barat</div>
                    <div class="font-bold text-white text-lg">Nama Turnamen di Jawa Barat</div>
                </div>
            </div>
        @endfor
    </div>
</div>
