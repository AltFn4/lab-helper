<x-app-layout>
    <form action="{{ route('inquiry.create') }}" method='post'>
        @csrf
        @method('POST')
        <div class="p-5 grid grid-cols-2 gap-5 text-white">
            <h1 class="text-3xl col-span-2">Request</h1>
            <div class="flex flex-col gap-2">
                <h2 class="text-xl">Code</h2>
                <div class="border-2 border-gray-500 rounded">
                    <textarea name="code" id="codeTextarea"></textarea>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <h2 class="text-xl">Details</h2>
                <div class="flex flex-col gap-2">
                    <label for="request-type">Type</label>
                    <select name="type" id="request-type" class="bg-gray-800 rounded" required>
                        <option value=""></option>
                        <option value="signoff">Sign off</option>
                        <option value="ask">Ask question</option>
                    </select>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="request-desc">Description</label>
                    <textarea name="desc" id="request-desc" cols="30" rows="5" class="bg-gray-800 rounded" placeholder="Describe the context of the request...">{{ isset($inquiry) ? $inquiry->desc : '' }}</textarea>
                </div>
                <button class="p-2 m-2 bg-green-500 text-white rounded">Queue</button>
            </div>
        </div>
    </form>
    <script>
        var codeTextarea = document.getElementById('codeTextarea');
        var editor = CodeMirror.fromTextArea(codeTextarea, {
            lineNumbers: true,
            mode: 'javascript',
            theme: 'yonce',
            styleActiveLine: true,
            matchBrackets: true,
        });
    </script>
</x-app-layout>