<div class="max-w-screen-lg mx-auto pt-4">
    <div style="min-height: calc(100vh - 56px - 78px - 188px);" class="md:p-0 p-2">
        <div class="md:text-2xl tex-xl mb-2">
            {{ $post->title }}
        </div>

        <div class="grid md:grid-cols-4 grid-cols-1 gap-2">

            <div class="md:col-span-3">
                <div class="mb-2 text-sm flex justify-between">
                    <div>
                        <b>TenisIndo.com</b> - {{ date('d M Y H:i', strtotime($post->created_at)) }}
                    </div>
                    <div class="bg-blue-200 px-2 rounded">
                        {{ $post->category->name }}
                    </div>
                </div>
                <div class="mb-2">
                    <img src="{{ $post->image }}" class="w-full" alt="">
                </div>
                <div>
                    <div class="text-sm">{!! $post->image_desc !!}</div>
                </div>
                <div class="mt-4">
                    <p>{!! $post->body_content !!}</p>
                </div>
            </div>
            <div>
                @foreach ($posts as $new)
                    <a href="/posts/{{ $new->id }}-{{ str_to_link($new->title) }}">
                        <div
                            class="md:col-span-1 md:h-auto h-32 row-span-1 col-span-4 shadow-md rounded-md p-3 flex justify-between">
                            <div class="text-sm w-2/3">
                                {{ truncate_str($new->title, 60) }}
                                <div class="text-xs italic text-slate-500">
                                    {{ date('d/m/y', strtotime($new->created_at)) }}
                                </div>
                            </div>
                            <div class="w-1/3 aspect-square bg-center bg-cover rounded-md"
                                style="background-image: url('{{ $new->image }}')">
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
