<section>
    <div class="bg-center bg-cover h-48 flex items-center"
         style="background-image: url('/assets/img/bg-image-blue.jpeg')">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl text-white">
                @if(isset($title))
                    {{$title}}
                @endif
            </h1>
            <p class="mb-8 text-lg font-normal text-gray-100 lg:text-xl sm:px-16 xl:px-48">
                @if(isset($sub_title))
                    {{$sub_title}}
                @endif
            </p>
        </div>
    </div>
</section>
