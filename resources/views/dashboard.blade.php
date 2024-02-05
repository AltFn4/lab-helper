<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col gap-5 justify-between items-center text-gray-100">
                <a href="{{route('select')}}">Select lab</a>
                
                @if (Auth::user()->role == 'student')
                <div class="p-5 bg-gray-700 max-w-fit rounded">
                    @if (Auth::user()->seat !== NULL)
                    <p>Lab: {{ Auth::user()->seat->lab->name }}</p>
                    <p>Seat no.: {{ Auth::user()->seat->id }}</p>
                    <form action="{{ route('leave')}}">
                        @csrf
                        @method("PATCH")
                        <x-danger-button>
                            leave
                        </x-danger-button>
                    </form>
                    @else
                    <p>Lab: -</p>
                    <p>Seat no. -</p>
                    @endif
                </div>
                <a href="{{route('request.upload')}}">Request assistance</a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
