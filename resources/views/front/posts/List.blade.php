<div class="max-w-screen-lg mx-auto pt-4">
    <div style="min-height: calc(100vh - 56px - 78px - 188px);" class="md:p-0 p-2">
        <div class="md:text-lg text-sm mb-2">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                @foreach ($posts as $post)
                    <a href="/posts/{{ $post->id }}-{{ str_to_link($post->title) }}">
                        <div class="shadow">
                            <div
                                class="md:col-span-1 md:h-auto h-32 row-span-1 col-span-4 shadow-md rounded-md p-3 flex justify-between">
                                <div class="w-1/5 aspect-square bg-center bg-cover rounded-md"
                                    style="background-image: url('{{ $post->image }}')">
                                </div>
                                <div class="w-4/5 px-2">
                                    <div class="text-xs italic">{{ date('d/m/y H:i', strtotime($post->created_at)) }}
                                    </div>
                                    {{ truncate_str($post->title, 80) }}
                                    <br>
                                    <p class="text-sm text-gray-500 hidden md:block">
                                        {!! truncate_str($post->title, 100) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
