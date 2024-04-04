<section>
    <div class="max-w-screen-lg mx-auto bg-slate-50 bg-center bg-cover rounded-md"
        style="background-image: url('/assets/img/bg-image-blue.jpeg')">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
            <h1 class="text-4xl font-extrabold tracking-tight leading-none md:text-5xl lg:text-6xl text-white">
                @if(isset($title))
                    {{$title}}
                @endif
            </h1>
            @if(isset($sub_title))
            <p class="mb-8 text-lg font-normal text-gray-100 lg:text-xl sm:px-16 xl:px-48">
                    {{$sub_title}}
                </p>
            @endif
        </div>
    </div>
</section>
