<div class="flex flex-col gap-2">
    <div class="flex flex-row justify-between">
        <h2 class="text-xl">Code</h2>
        <div>
            <label for="languageMode">Mode:</label>
            <select id="languageMode" class="text-gray-800 rounded">
                <option value="javascript">Javascript</option>
                <option value="python">Python</option>
                <option value="htmlmixed">HTML</option>
                <option value="css">CSS</option>
                <option value="xml">XML</option>
            </select>
        </div>
    </div>
    <div class="rounded border-2 border-gray-500">
        <textarea name="code" id="codeTextarea">{{ $code ?? "" }}</textarea>
    </div>
</div>
