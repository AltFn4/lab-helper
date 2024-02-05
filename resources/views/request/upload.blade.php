<x-app-layout>
    <div class="p-5 m-5">
        <form action="">
            <textarea name="code" id="code" cols="30" rows="20" class="bg-gray-900 text-white rounded">

            </textarea>
            <select name="request_type" id="request_type">
                <option value="sign-off">
                    sign-off
                </option>
                <option value="help">
                    help
                </option>
            </select>
            <x-primary-button type="button" onclick="queue()">
                Request
            </x-primary-button>
        </form>
        
    </div>
    <div id="queue_status" class="p-5 flex flex-row justify-between gap-5 bg-gray-800 text-white w-full absolute bottom-0 hidden">
        <p id="status">In queue</p>
        <p id="position">Position: 50</p>
    </div>
</x-app-layout>
<script>
    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }
    async function queue() {
        var queue_status = document.getElementById("queue_status");
        queue_status.style.display = "block";
        var status = document.getElementById("status");
        var position = document.getElementById("position");
        for (let i = 10; i > 0; i--) {
            position.innerHTML = `Position: ${i}`;
            await sleep(1000);
        }
        queue_status.style.backgroundColor = "orange";
        status.innerHTML = "Reviewing"
        position.innerHTML = ""

        await sleep(2000);
        queue_status.style.backgroundColor = "green";
        status.innerHTML = "Help is on the way!"
    }
</script>