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
                    @if(Auth::user()->seat != NULL)
                    <p>
                        Lab: {{ Auth::user()->seat->lab->name }}
                    </p>
                    <p>
                        Seat: {{ Auth::user()->seat->id }}
                    </p>
                    <form action="{{ route('labs.leave') }}" method="POST">
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
                <div class="p-4 flex flex-col gap-3 bg-gray-500 rounded ">
                    <p class="text-gray-100 text-lg">
                        Get help
                    </p>
                    <form action="{{ route('request.edit') }}" method="GET">
                        @csrf
                        @method('GET')
                        <x-primary-button>
                            request
                        </x-primary-button>
                </form>
                </div>
                
            </div>
    </div>
</x-app-layout>
