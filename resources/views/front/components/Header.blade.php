<nav class="bg-white border-gray-200 px-2 md:px-4 py-2.5 dark:bg-gray-900">
    <div class="flex flex-wrap items-center justify-between max-w-screen-lg mx-auto">
        <a href="/" class="flex items-center">
            <img src="/assets/logo/logo-tenis-demo.png" class="h-6 mr-3 sm:h-9" alt="Logo" />
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">
                <span class="text-blue-600">Tenis</span><span class="text-red-600">Indo</span>
            </span>
        </a>
        <div id="mega-menu" class="items-center justify-between hidden w-full text-sm md:flex md:w-auto md:order-1">
            <ul class="flex flex-col font-medium md:flex-row md:space-x-8 md:mt-0">
                <li>
                    <a href="/"
                        class="block py-2 pl-3 pr-4 {{ $page_name == 'home' ? 'text-blue-600' : 'text-gray-700' }} border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0"
                        aria-current="page">Beranda</a>
                </li>
                <li>
                    <a href="/players"
                        class="block py-2 pl-3 pr-4 {{ $page_name == 'players' ? 'text-blue-600' : 'text-gray-700' }} border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0">Pemain</a>
                </li>
                <li>
                    <a href="/competitions"
                        class="block py-2 pl-3 pr-4 {{ $page_name == 'competitions' ? 'text-blue-600' : 'text-gray-700' }} border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0">Turnamen</a>
                </li>
                <li>
                    <a href="/matches"
                        class="block py-2 pl-3 pr-4 {{ $page_name == 'matches' ? 'text-blue-600' : 'text-gray-700' }} border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0">Pertandingan</a>
                </li>
                <li>
                    <a href="/news"
                        class="block py-2 pl-3 pr-4 {{ $page_name == 'news' ? 'text-blue-600' : 'text-gray-700' }} border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0">Berita</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
