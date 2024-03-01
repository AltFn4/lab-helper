<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 auto-rows-auto gap-5 p-5">
                <p class="text-white col-span-3">
                    Welcome back, {{ Auth::user()->name }}!
                </p>
                <div class="p-4 flex flex-col gap-3 bg-gray-500 rounded col-span-2">
                    <p class="text-gray-100 text-lg">
                        Status
                    </p>
                    @if(Auth::user()->role == 'student')
                    @if(Auth::user()->seat)
                    <p>
                        Lab: {{ Auth::user()->seat->lab->name }}
                    </p>
                    <p>
                        Seat: {{ Auth::user()->seat->id }}
                    </p>
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
                    @else
                    @if(Auth::user()->lab)
                    <p>
                        Lab: {{ Auth::user()->lab->name }}
                    </p>
                    <form action="{{ route('lab.leave') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>
                            leave
                        </x-danger-button>
                    </form>
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
                    @endif
                </div>
                @if(Auth::user()->seat)
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
                @if(Auth::user()->lab)
                <div class="p-4 flex flex-col gap-3 bg-gray-500 rounded ">
                    @if(Auth::user()->inquiry == NULL)
                    <p class="text-gray-100 text-lg">
                        Start helping
                    </p>
                    <form action="{{ route('inquiry.index') }}" method="GET">
                        @csrf
                        @method('GET')
                        <x-primary-button>
                            See requests
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
            </div>
    </div>
</x-app-layout>
