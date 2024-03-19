<section class="grid grid-cols-3 auto-rows-auto gap-5">
    <div class="p-4 flex flex-col gap-3 bg-gray-500 rounded col-span-2">
        <p class="text-gray-100 text-lg">
            Status
        </p>

        @if(Auth::user()->seat)
        <p>Lab: {{ Auth::user()->lab->room->name }}</p>
        <p>Module: {{ Auth::user()->lab->module->name }}</p>
        <p>Seat: {{ Auth::user()->seat->id }}</p>
        <form action="{{ route('seat.leave') }}" method="POST">
            @csrf
            @method('DELETE')
            <x-danger-button>
                leave
            </x-danger-button>
        </form>
        @else
        <p>
            Please select a lab and seat.
        </p>
        <form action="{{ route('labs.index') }}" method="GET">
            @csrf
            @method('GET')
            <x-primary-button>
                select
            </x-primary-button>
        </form>
        @endif
    </div>
    @if(Auth::user()->seat != NULL)
    <div class="p-4 flex flex-col gap-3 bg-gray-500 rounded ">
        @if(Auth::user()->inquiry == NULL)
        <p class="text-gray-100 text-lg">
            Get help
        </p>
        <form action="{{ route('inquiry.edit') }}" method="GET">
            @csrf
            @method('GET')
            <x-primary-button>
                request
            </x-primary-button>
        </form>
        @else
        <p class="text-gray-100 text-lg">
            Your request
        </p>
        <p>Time elapsed: {{ Auth::user()->inquiry->created_at->diffInMinutes(Carbon\Carbon::now()) }} mins</p>
        <form action="{{ route('inquiry.show') }}" method="GET">
            @csrf
            @method('GET')
            <input type="hidden" name="inquiry_id" value="{{ Auth::user()->inquiry->id }}">
            <x-primary-button>
                inspect
            </x-primary-button>
        </form>
        @endif
    </div>
    @endif
</section>
