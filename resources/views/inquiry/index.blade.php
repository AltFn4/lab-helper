<x-app-layout>
    <div class="p-5 m-5 text-white">
        <h2 class="text-3xl">Requests</h2>
        <div class="flex">
            <button id="signoff-btn" class="p-2 m-2 bg-green-500 selected:bg-green-800 selected:animate-select rounded">
                Sign-offs ({{ $inquiries->filter(function($in){return $in->type == 'Sign off';})->count() }})
            </button>
            <button id="ask-btn" class="p-2 m-2 bg-yellow-500 selected:bg-yellow-800 selected:animate-select rounded">
                Ask question ({{ $inquiries->filter(function($in){return $in->type == 'Ask question';})->count() }})
            </button>
        </div>

        <div class="p-2 grid grid-cols-1 gap-5">
            @foreach ($inquiries as $inquiry)
            <form class="{{ $inquiry->type == 'Sign off' ? 'signoff' : 'ask' }}" action="{{ route('inquiry.show') }}" method="get">
                @csrf
                @method("GET")
                <input type="hidden" name="inquiry_id" value="{{ $inquiry->id }}">
                <div class="p-5 flex flex-col gap-2 bg-gray-700 text-gray-100 rounded">
                    <h2 class="text-3xl">{{ $inquiry->type }}</h2>
                    <p>Student name: {{ $inquiry->student->name }}</p>
                    <p class="truncate">Description: {{ $inquiry->desc }}</p>
                    <p>Time elapsed: {{ $inquiry->created_at->diffInMinutes(Carbon\Carbon::now()) }} mins</p>
                    <span>
                        <x-primary-button>
                            Inspect
                        </x-primary-button>
                    </span>
                </div>
            </form>
            @endforeach
        </div>
    </div>

    <script>
        $('#signoff-btn').click(function() {
            $(this).toggleClass('selected');
            $('.signoff').toggle();
        });
        $('#ask-btn').click(function() {
            $(this).toggleClass('selected');
            $('.ask').toggle();
        });
    </script>
</x-app-layout>
