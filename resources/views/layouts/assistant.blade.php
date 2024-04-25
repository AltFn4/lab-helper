<section class="grid grid-cols-3 auto-rows-auto gap-5">
    <div class="flex flex-col col-span-2 gap-3 p-4 bg-gray-500 rounded">
        <p class="text-lg text-gray-100">
            Status
        </p>
        @if(Auth::user()->lab)
        <div class="flex flex-row gap-2">
            <div class="flex flex-col gap-2">
                <p class="p-2 text-center text-white bg-gradient-to-b from-sky-500 to-sky-600 rounded-md">Module</p>
                <p class="p-2 text-center text-white bg-gradient-to-b from-sky-600 to-sky-700 rounded-md">Room</p>
                <p class="p-2 text-center text-white bg-gradient-to-b from-sky-700 to-sky-800 rounded-md">Start time</p>
                <p class="p-2 text-center text-white bg-gradient-to-b from-sky-800 to-sky-900 rounded-md">Duration</p>
            </div>
            <div class="flex flex-col gap-2">
                <p class="p-2 text-gray-800">{{ Auth::user()->lab->module->name }}</p>
                <p class="p-2 text-gray-800">{{ Auth::user()->lab->room->name }}</p>
                <p class="p-2 text-gray-800">{{ Auth::user()->lab->start_time }}</p>
                <p class="p-2 text-gray-800">{{ Auth::user()->lab->duration }} hour(s)</p>
            </div>
        </div>
        <div>
            <x-danger-button id="activate-btn" type="button">
                leave
            </x-danger-button>
        </div>
        <x-confirm-prompt route="{{ route('lab.leave') }}" message="Are you sure you want to leave the lab?" />
        @else
        <p>
            Please select a lab.
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
    @if(Auth::user()->lab != NULL)
    <div class="flex flex-col p-4 bg-gray-500 rounded">
        @if(Auth::user()->inquiry == NULL)
        <p class="text-lg text-gray-100">
            Start helping
        </p>
        <div class="shrink-0 grid grid-rows-2 justify-center">
            <p class="text-sm text-gray-800 text-center">No active request.</p>
            <form action="{{ route('inquiry.index') }}" method="GET">
                @csrf
                @method('GET')

                <x-primary-button>
                    See requests
                </x-primary-button>
            </form>
        </div>
        @else
        <p class="text-lg text-gray-100">
            Your request
        </p>
        <div class="p-2 flex flex-row gap-2">
            <div class="flex flex-col gap-2">
                <p class="p-2 text-center text-white bg-gradient-to-b from-indigo-500 to-indigo-600 rounded-md">Time elapsed</p>
            </div>
            <div class="flex flex-col gap-2">
                <p class="p-2 text-gray-800">{{ Auth::user()->inquiry->created_at->diffInMinutes(Carbon\Carbon::now()) }} mins</p>
            </div>
        </div>
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
