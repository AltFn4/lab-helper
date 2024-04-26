<x-app-layout>
    <form action="{{ route('inquiry.create') }}" method='post'>
        @csrf
        @method('POST')
        <div class="grid grid-cols-2 gap-5 p-5 text-white">
            <h1 class="col-span-2 text-3xl">Request</h1>

            @include('inquiry.partials.editor')

            <div class="flex flex-col gap-2">
                <h2 class="text-xl">Details</h2>
                <div class="flex flex-col gap-2">
                    <label for="request-type">Type</label>
                    <select name="type" id="request-type" class="bg-gray-800 rounded" required>
                        <option value=""></option>
                        <option value="Sign off">Sign off</option>
                        <option value="Ask question">Ask question</option>
                    </select>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="request-desc">Description</label>
                    <textarea name="desc" id="request-desc" cols="30" rows="5" class="bg-gray-800 rounded" placeholder="Describe the context of the request...">{{ isset($inquiry) ? $inquiry->desc : '' }}</textarea>
                    <label for="link">External link</label>
                    <textarea name="link" id="link" cols="30" rows="1" class="bg-gray-800 rounded" placeholder="Add an external link of the request..."></textarea>
                </div>
                <button class="p-2 m-2 text-white bg-green-500 rounded">Queue</button>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            var codeTextarea = document.getElementById('codeTextarea');
            var editor = CodeMirror.fromTextArea(codeTextarea, {
                lineNumbers: true,
                mode: 'javascript',
                theme: 'yonce',
                styleActiveLine: true,
                matchBrackets: true,
                indentWithTabs: true,
                indentUnit: 4,
                autoCloseTags: true,
                autoCloseBrackets: true,
            });

            var languageMode = $('#languageMode');
            languageMode.change(function() {
                editor.setOption('mode', languageMode.val());
            });
        });
    </script>
</x-app-layout>
