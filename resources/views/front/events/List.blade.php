<div class="max-w-screen-lg mx-auto p-3">
    <div class="flex items-center justify-between pb-4 bg-white dark:bg-gray-900">
        <div>
            <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
                    class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                    type="button">
                <span class="sr-only">Action button</span>
                Kategori: Junior 16
                <svg class="w-3 h-3 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdownAction"
                 class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownActionButton">
                    <li>
                        <a href="#"
                           class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            12 Tahun
                        </a>
                    </li>
                    <li>
                        <a href="#"
                           class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            14 Tahun
                        </a>
                    </li>
                    <li>
                        <a href="#"
                           class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            16 Tahun
                        </a>
                    </li>
                    <li>
                        <a href="#"
                           class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            Senior Pria
                        </a>
                    </li>
                    <li>
                        <a href="#"
                           class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            Senior Wanita
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <label for="table-search" class="sr-only">Cari</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                          clip-rule="evenodd"></path>
                </svg>
            </div>
            <input type="text" id="table-search-users"
                   class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   placeholder="Cari Pemain">
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nama
                </th>
                <th scope="col" class="px-6 py-3">
                    Gender
                </th>
                <th scope="col" class="px-6 py-3">
                    Asal Kota
                </th>
                <th scope="col" class="px-6 py-3">
                    Poin
                </th>
                <th scope="col" class="px-6 py-3">
                    Kategori
                </th>
            </tr>
            </thead>
            <tbody>
            <tr onclick="window.location='/players/22';" class="cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                    <img class="w-10 h-10 rounded-full" src="/assets/logo/icon-male.jpg"
                         alt="Male image">
                    <div class="pl-3">
                        <div class="text-base font-semibold">Rumangsa Diwan</div>
                        <div class="font-normal text-gray-500">14 thn 3 bln</div>
                    </div>
                </th>
                <td class="px-6 py-4">
                    Laki-laki
                </td>
                <td class="px-6 py-4">
                    Madiun
                </td>
                <td class="px-6 py-4">
                    <div class="text-base font-semibold">233</div>
                </td>
                <td class="px-6 py-4">
                    Junior 16 Tahun
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                    <img class="w-10 h-10 rounded-full" src="/assets/logo/icon-male.jpg"
                         alt="Male image">
                    <div class="pl-3">
                        <div class="text-base font-semibold">Rumangsa Diwan</div>
                        <div class="font-normal text-gray-500">14 thn 3 bln</div>
                    </div>
                </th>
                <td class="px-6 py-4">
                    Laki-laki
                </td>
                <td class="px-6 py-4">
                    Madiun
                </td>
                <td class="px-6 py-4">
                    <div class="text-base font-semibold">233</div>
                </td>
                <td class="px-6 py-4">
                    Junior 16 Tahun
                </td>
            </tr>

            </tbody>
        </table>
    </div>
</div>
