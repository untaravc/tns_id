<div class="max-w-screen-lg mx-auto pt-4">
    <div style="min-height: calc(100vh - 56px - 78px - 188px);" class="md:p-0 p-2">
        <div class="md:text-2xl tex-xl mb-2">
            @foreach($competitions as $competition)
            <a href="/competitions/{{$competition->id}}-{{str_to_link($competition->name)}}">
                <div class="shadow">
                    <div
                        class="md:col-span-1 md:h-auto h-32 row-span-1 col-span-4 shadow-md rounded-md p-3 flex justify-between">
                        <div class="w-1/5 aspect-square bg-center bg-cover rounded-md"
                            style="background-image: url('')">
                        </div>
                        <div class="text w-4/5 p-2">
                            {{$competition->name}}
                            <div class="italic text-slate-500">
                                {{$competition->date_start}}
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>