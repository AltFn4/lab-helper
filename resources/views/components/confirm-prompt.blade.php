<div class="flex content-center fixed top-0 left-0 w-full h-full bg-gray-500/[.9] hidden z-10" id="prompt">
    <div class="p-5 mx-auto bg-gray-600 text-center w-fit rounded shadow-2xl">
        <p class="m-2 text-white">{{ $message }}</p>
        <ul class="m-2 grid grid-cols-2 justify-between">
            <li>
                <form action="{{ $route }}" method="POST">
                    @csrf
                    @method('DELETE')
                    {{ $slot }}
                    <x-primary-button>
                        Yes
                    </x-primary-button>
                </form>
            </li>
            <li>
                <x-danger-button id="no-btn" type="button">
                    No
                </x-danger-button>
            </li>
        </ul>
    </div>
</div>

<script>
    $(document).ready(function() {
        var prompt = $('#prompt');
        var noBtn = $('#no-btn');
        var activateBtn = $('#activate-btn');

        activateBtn.on('click', function() {
            prompt.css('display', 'block');
        });

        noBtn.on('click', function() {
            prompt.css('display', 'none');
        });
    });
</script>
