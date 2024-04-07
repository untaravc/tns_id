<div class="max-w-screen-lg mx-auto pt-4">
    <div style="min-height: calc(100vh - 56px - 78px - 188px);" class="md:p-0 p-2">
        <div class="flex">
            <a href="/players?category=U10" class="rounded-md border border-blue-500 @if(request('category') == 'U10') bg-blue-500 text-white @else bg-blue-200 @endif px-2 py-1 mr-1 hover:cursor-pointer">Under 10</a>
            <a href="/players?category=U12" class="rounded-md border border-blue-500 @if(request('category') == 'U12') bg-blue-500 text-white @else bg-blue-200 @endif px-2 py-1 mr-1 hover:cursor-pointer">Under 12</a>
            <a href="/players?category=U14" class="rounded-md border border-blue-500 @if(request('category') == 'U14') bg-blue-500 text-white @else bg-blue-200 @endif px-2 py-1 mr-1 hover:cursor-pointer">Under 14</a>
            <a href="/players?category=U16" class="rounded-md border border-blue-500 @if(request('category') == 'U16') bg-blue-500 text-white @else bg-blue-200 @endif px-2 py-1 mr-1 hover:cursor-pointer">Under 16</a>
            <a href="/players?category=U18" class="rounded-md border border-blue-500 @if(request('category') == 'U18') bg-blue-500 text-white @else bg-blue-200 @endif px-2 py-1 mr-1 hover:cursor-pointer">Under 18</a>
            <a href="/players?category=SENIOR" class="rounded-md border border-blue-500 @if(request('category') == 'SENIOR') bg-blue-500 text-white @else bg-blue-200 @endif px-2 py-1 mr-1 hover:cursor-pointer">Senior</a>
        </div>
    </div>
</div>