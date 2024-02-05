<x-app-layout>
    <div class="p-5 m-5">
        <div>
            <p class="text-5xl text-white text-center">
                Code review
            </p>
            <p class="text-gray-100 text-center">
                {{ $submission->user->name }}
            </p>
        </div>
        <div>
            <form action="">
                <textarea name="code" id="code" cols="30" rows="20" class="bg-gray-900 text-white rounded">
                    {{ $submission->code }}
                </textarea>
                <x-primary-button type="button" onclick="click(this)">
                    assign
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
<script>
    function click(button) {
        if (button.value == "assign") {
            button.value = "finish"
        } else {
            button.value = "sign-off"
        }
    }
</script>