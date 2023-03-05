<div class="max-w-screen-lg mx-auto p-3">
    <div class="grid grid-cols-1 gap-2 lg:grid-cols-2">
        <div>
            <div class="bg-cyan-800 py-3 px-5 text-white font-bold inline-block">Junior Player</div>
            <div class="border-b-cyan-800 border-b-4 w-full"></div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-3">
                @for($i = 1; $i < 6; $i++)
                    <div class="border p-4 border-gray-200 rounded-lg shadow bg-white">
                        <div class="flex justify-center items-center">
                            <img class="rounded-full w-9 h-9" alt="pic"
                                 src="/assets/logo/icon-female.jpg">
                            <div class="ml-2">
                                <div class="font-bold text-base">Nama Pemain</div>
                                <div class="italic text-sm">Keterangan, 14th</div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
        <div>
            <div class="bg-cyan-800 py-3 px-5 text-white font-bold inline-block">Junior Player</div>
            <div class="border-b-cyan-800 border-b-4 w-full"></div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-3">
                @for($i = 1; $i < 6; $i++)
                    <div class="border p-4 border-gray-200 rounded-lg shadow bg-white">
                        <div class="flex justify-center items-center">
                            <img class="rounded-full w-9 h-9" alt="pic"
                                 src="/assets/logo/icon-male.jpg">
                            <div class="ml-2">
                                <div class="font-bold text-base">Nama Pemain</div>
                                <div class="italic text-sm">Keterangan, 14th</div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>
