<div class="max-w-screen-lg mx-auto pt-4">
    <div style="min-height: calc(100vh - 56px - 78px - 188px);" class="md:p-0 p-2">
        <div class="flex justify-between">
            <div class="flex">
                <a href="{{ request()->fullUrlWithQuery(['category' => '']) }}" class="rounded-md border border-blue-600 @if(request('category') == '') bg-blue-800 text-white @else bg-blue-50 @endif px-2 py-1 mr-1 hover:cursor-pointer">Semua</a>
                <a href="{{ request()->fullUrlWithQuery(['category' => 'U10']) }}" class="rounded-md border border-blue-600 @if(request('category') == 'U10') bg-blue-800 text-white @else bg-blue-50 @endif px-2 py-1 mr-1 hover:cursor-pointer">Under 10</a>
                <a href="{{ request()->fullUrlWithQuery(['category' => 'U12']) }}" class="rounded-md border border-blue-600 @if(request('category') == 'U12') bg-blue-800 text-white @else bg-blue-50 @endif px-2 py-1 mr-1 hover:cursor-pointer">Under 12</a>
                <a href="{{ request()->fullUrlWithQuery(['category' => 'U14']) }}" class="rounded-md border border-blue-600 @if(request('category') == 'U14') bg-blue-800 text-white @else bg-blue-50 @endif px-2 py-1 mr-1 hover:cursor-pointer">Under 14</a>
                <a href="{{ request()->fullUrlWithQuery(['category' => 'U16']) }}" class="rounded-md border border-blue-600 @if(request('category') == 'U16') bg-blue-800 text-white @else bg-blue-50 @endif px-2 py-1 mr-1 hover:cursor-pointer">Under 16</a>
                <a href="{{ request()->fullUrlWithQuery(['category' => 'U18']) }}" class="rounded-md border border-blue-600 @if(request('category') == 'U18') bg-blue-800 text-white @else bg-blue-50 @endif px-2 py-1 mr-1 hover:cursor-pointer">Under 18</a>
                <a href="{{ request()->fullUrlWithQuery(['category' => 'SENIOR']) }}" class="rounded-md border border-blue-600 @if(request('category') == 'SENIOR') bg-blue-800 text-white @else bg-blue-50 @endif px-2 py-1 mr-1 hover:cursor-pointer">Senior</a>
            </div>
            <div class="flex">
                <a href="{{ request()->fullUrlWithQuery(['gender' => 'F']) }}" class="rounded-md border border-blue-600 @if(request('gender') == 'F') bg-blue-800 text-white @else bg-blue-50 @endif px-2 py-1 mr-1 hover:cursor-pointer">Perempuan</a>
                <a href="{{ request()->fullUrlWithQuery(['gender' => 'M']) }}" class="rounded-md border border-blue-600 @if(request('gender') == 'M') bg-blue-800 text-white @else bg-blue-50 @endif px-2 py-1 mr-1 hover:cursor-pointer">Laki-laki</a>
                <a href="{{ request()->fullUrlWithQuery(['gender' => '']) }}" class="rounded-md border border-blue-600 @if(request('gender') == '') bg-blue-800 text-white @else bg-blue-50 @endif px-2 py-1 mr-1 hover:cursor-pointer">Semua</a>
            </div>
        </div>
        <div>            

        </div>
    </div>
</div>