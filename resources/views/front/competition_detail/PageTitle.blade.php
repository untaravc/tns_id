<section>
    <div class="max-w-screen-lg mx-auto p-4 bg-slate-50 bg-center bg-cover rounded-md"
        style="background-image: url('/assets/img/bg-image-blue.jpeg')">
        <div class="md:p-0 p-2 mt-28">
            <div class="text-2xl text-white font-bold">{{ $competition->name }}</div>
            <div class="b bg-gradient-to-r from-lime-400 to-lime-900 h-1"></div>
            <div class="flex items-center mt-4">
                <div class="py-1 px-4">
                    <div class="text-sm text-slate-400">Kota</div>
                    <div class="font-bold text-xl text-slate-50"> {{ $competition->address }} </div>
                </div>
                <div class="border-r border-lime-400 h-8"></div>
                <div class="py-1 px-4">
                    <div class="text-sm text-slate-400">Kategori</div>
                    <div class="font-bold text-xl text-slate-50"> {{ $competition->competition_category_code }} </div>
                </div>
                <div class="border-r border-lime-400 h-8"></div>
                <div class="py-1 px-4">
                    <div class="text-sm text-slate-400">Tanggal</div>
                    <div class="font-bold text-xl text-slate-50">
                        @if (date('M', strtotime($competition->date_start)) == date('M', strtotime($competition->date_start)))
                            {{ date('j', strtotime($competition->date_start)) }}
                        @else
                            {{ date('j M', strtotime($competition->date_start)) }}
                        @endif
                        - {{ date('j M Y', strtotime($competition->date_end)) }}
                    </div>
                </div>
                <div class="border-r border-lime-400 h-8"></div>
                <div class="py-1 px-4">
                    <div class="text-sm text-slate-400">Pertandingan</div>
                    <div class="font-bold text-xl text-slate-50">-</div>
                </div>
                <div class="border-r border-lime-400 h-8"></div>
            </div>
        </div>
    </div>
</section>
