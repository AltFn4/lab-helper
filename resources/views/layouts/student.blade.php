<section class="grid grid-cols-3 auto-rows-auto gap-5">
    <div class="flex flex-col col-span-2 gap-3 p-4 bg-gray-500 rounded">
        <p class="text-lg text-gray-100">
            Status
        </p>

        @if(Auth::user()->seat)
        <div class="p-2 flex flex-row gap-2">
            <div class="flex flex-col gap-2">
                <p class="p-2 text-center text-white bg-gradient-to-b from-sky-500 to-sky-600 rounded-md">Module</p>
                <p class="p-2 text-center text-white bg-gradient-to-b from-sky-600 to-sky-700 rounded-md">Room</p>
                <p class="p-2 text-center text-white bg-gradient-to-b from-sky-700 to-sky-800 rounded-md">Seat</p>
                <p class="p-2 text-center text-white bg-gradient-to-b from-sky-800 to-sky-900 rounded-md">Start time</p>
                <p class="p-2 text-center text-white bg-gradient-to-b from-sky-900 to-sky-950 rounded-md">Duration</p>
            </div>
            <div class="flex flex-col gap-2">
                <p class="p-2 text-gray-800">{{ Auth::user()->lab->module->name }}</p>
                <p class="p-2 text-gray-800">{{ Auth::user()->lab->room->name }}</p>
                <p class="p-2 text-gray-800">{{ Auth::user()->seat->id }}</p>
                <p class="p-2 text-gray-800">{{ Auth::user()->lab->start_time }}</p>
                <p class="p-2 text-gray-800">{{ Auth::user()->lab->duration }} hour(s)</p>
            </div>
        </div>
        <div class="flex">
            <div id="seat-plan" class="p-2 bg-gray-500 border-2 border-gray-700 rounded">
                <span class="grid grid-rows-4 grid-flow-col gap-1 justify-between">
                    @foreach(Auth::user()->lab->room->seats as $seat)
                    @if($seat->id == Auth::user()->seat->id)
                    <x-used-seat-logo width="20" height="20"></x-used-seat-logo>
                    @else
                    <x-empty-seat-logo width="20" height="20"></x-empty-seat-logo>
                    @endif
                    @endforeach
                </span>
            </div>
        </div>
        <div>
            <x-danger-button id="activate-btn" type="button">
                leave
            </x-danger-button>
        </div>
        <x-confirm-prompt route="{{ route('seat.leave') }}" message="Are you sure you want to leave the lab?" />
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
    <div class="flex flex-col gap-3 p-4 bg-gray-500 rounded">
        @if(Auth::user()->inquiry == NULL)
        <p class="text-lg text-gray-100">
            Get help
        </p>
        <p class="text-sm text-gray-800">No active request.</p>
        <form action="{{ route('inquiry.edit') }}" method="GET">
            @csrf
            @method('GET')
            <x-primary-button>
                request
            </x-primary-button>
        </form>
        @else
        <p class="text-lg text-gray-100">
            Your request
        </p>
        @include('layouts.partials.status')
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
    <div class="flex flex-col col-span-2 gap-3 p-4 bg-gray-500 rounded">
        <p class="text-lg text-gray-100">
            Sign-off Log
        </p>
        <div class="grid gap-3 grid-col-1">
            @if(Auth::user()->signoffs->count() == 0)
            <p class="text-center text-gray-800">No sign-off record.</p>
            @endif
            @foreach(Auth::user()->signoffs as $signoff)
            <div class="grid grid-cols-2">
                <p>
                    > {{ $signoff->lab->module->name }}
                </p>
                <a class="text-sm text-right text-gray-800">[{{ $signoff->created_at }}]</a>
            </div>
            @endforeach
        </div>

    </div>
</section>
