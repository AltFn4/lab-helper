<section class="p-2 grid grid-cols-3 gap-5 bg-gray-500">
    <a class="p-2 {!! $stage == 'lab' ? 'bg-green-500' : 'bg-white' !!} text-center">
        @isset($lab)
        {{ $lab->room->name }}
        @else
        Select lab
        @endisset
    </a>
    <a class="p-2 {!! $stage == 'seat' ? 'bg-green-500' : 'bg-white' !!} text-center">
        @isset($seat)
        {{ $seat->id }}
        @else
        Select seat
        @endisset
    </a>
    <p class="p-2 {!! $stage == 'done' ? 'bg-green-500' : 'bg-white' !!} text-center">Done</p>
</section>
<p>

</p>
