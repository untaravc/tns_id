<div class="max-w-screen-lg mx-auto pt-4">
    <div style="min-height: calc(100vh - 56px - 78px - 188px);" class="md:p-0 p-2">
        <div class="mb-2">
            <div class="grid gap-2 md:grid-cols-2 grid-cols-1">
                @foreach ($competitions as $competition)
                    <a href="/competitions/{{ $competition->id }}-{{ str_to_link($competition->name) }}">
                        <div class="shadow">
                            <div
                                class="md:col-span-1 md:h-auto h-32 row-span-1 col-span-4 shadow-md rounded-md p-3 flex justify-between">
                                <div class="md:w-1/5 w-2/5 aspect-square bg-center bg-cover rounded-md"
                                    style="background-image: url('{{ $competition->image }}')">
                                </div>
                                <div class="text md:w-4/5 w-3/5 p-2">
                                    <span class="text-md font-bold">{{ $competition->name }}</span>
                                    <div class="text-sm italic text-slate-500">
                                        {{ date('d M Y', strtotime($competition->date_start)) }}
                                    </div>
                                    <div>{{ $competition->address }}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
