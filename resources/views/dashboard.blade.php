<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p class="text-white">
                Welcome back, {{ Auth::user()->name }}!
            </p>

            @if(Auth::user()->hasRole('student'))
                @include('layouts.student')
            @elseif(Auth::user()->hasRole('assistant'))
                @include('layouts.assistant')
            @endif
        </div>
</x-app-layout>
