<div class="max-w-screen-lg mx-auto pt-4">
    <div style="min-height: calc(100vh - 56px - 78px);" class="md:p-0 p-2">
        @foreach($match_types as $match_type)
        <div class="text-lg font-normal leading-4 border-l border-red-700 ps-2 mt-2 mb-3">
            Tunggal Putra
        </div>
        <div class="grid grid-cols-3 gap-2">
            <div class="p-2 border rounded-md">
                <div class="pt-2 text-xs">
                    <div class="t font-medium">
                        NEW ARMADA CUP XXVI 2024
                    </div>
                    <div class="flex justify-between mb-2 text-slate-600">
                        <div>
                            08/02/24
                        </div>
                        <div>
                            Final
                            - Ganda Putri
                        </div>
                    </div>
                    <table class="w-full">
                        <tbody>
                            <tr>
                                <td class="flex">
                                    <div class="w-8" title="SOLO">
                                        SOLO
                                    </div>
                                    <div class="font-medium" title="SAAFIA devani putri">
                                        SAAFIA devani ..
                                    </div>
                                </td>
                                <td class="text-right">
                                    <span class="font-medium">
                                        5
                                    </span>
                                    <span class="font-medium">
                                        4
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="flex">
                                    <div class="w-8" title="BALI">
                                        BALI
                                    </div>
                                    <div class="font-medium" title="MISCHA annebella tandio">
                                        MISCHA annebel..
                                    </div>
                                </td>
                                <td class="text-right">
                                    <span>
                                        3
                                    </span>
                                    <span>
                                        2
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>