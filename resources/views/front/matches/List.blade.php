<div class="max-w-screen-lg mx-auto p-3" style="min-height: calc(100vh - 56px - 192px - 68px)">
    <div class="flex items-center justify-between pb-4 bg-white dark:bg-gray-900">
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
        <table class="w-full text-sm text-gray-500 text-center">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">
                        Tanggal
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Pemain
                    </th>
                    <th scope="col" colspan="2" class="px-6 py-3 text-center">
                        Poin
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="cursor-pointer bg-white">
                    <td class="px-3 py-2" rowspan="2">
                        2 Sept 2024
                    </td>
                    <td class="px-3 py-2">
                        Wulan
                    </td>
                    <td class="px-3 py-2">
                        <div class="text-base font-semibold">2</div>
                    </td>
                    <td class="px-3 py-2">
                        6 4 6
                    </td>
                </tr>
                <tr class="cursor-pointer bg-white">
                    <td class="px-3 py-2">
                        Santi
                    </td>
                    <td class="px-3 py-2">
                        <div class="text-base font-semibold">1</div>
                    </td>
                    <td class="px-3 py-2">
                        4 6 1
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
