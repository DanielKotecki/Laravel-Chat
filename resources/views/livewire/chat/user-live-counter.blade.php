<div>
    @if($userCount !== 0)
        <div class="flex items-center gap-2 p-2">
            <span class="inline-block w-3 h-3 rounded-full bg-green-500"></span>
            <div class="badge badge-success badge-lg">{{$userCount}}</div>
            <span class="font-semibold">Online</span>
        </div>
    @else
        <div class="flex items-center gap-2 p-2">
            <span class="inline-block w-3 h-3 rounded-full bg-red-500"></span>
            <div class="badge badge-error badge-lg">{{$userCount}}</div>
            <span class="font-semibold">Online</span>
        </div>
    @endif
</div>
