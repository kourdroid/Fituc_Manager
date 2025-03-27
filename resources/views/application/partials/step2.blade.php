<div class="grid gap-4">
    <!-- Summary in Original Language -->
    <div class="space-y-1">
        <label for="original_summary" class="block font-medium text-gray-700">Summary (Original Language)</label>
        <textarea
            name="original_summary"
            id="original_summary"
            rows="4"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="Enter the summary of your play in its original language"
        >{{ old('original_summary') }}</textarea>
        @error('original_summary')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Summary in English -->
    <div class="space-y-1">
        <label for="english_summary" class="block font-medium text-gray-700">Summary (English)</label>
        <textarea
            name="english_summary"
            id="english_summary"
            rows="4"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="Enter an English summary"
        >{{ old('english_summary') }}</textarea>
        @error('english_summary')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Summary in French -->
    <div class="space-y-1">
        <label for="french_summary" class="block font-medium text-gray-700">Summary (French)</label>
        <textarea
            name="french_summary"
            id="french_summary"
            rows="4"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="Enter a French summary"
        >{{ old('french_summary') }}</textarea>
        @error('french_summary')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Summary in Arabic -->
    <div class="space-y-1">
        <label for="arabic_summary" class="block font-medium text-gray-700">Summary (Arabic)</label>
        <textarea
            name="arabic_summary"
            id="arabic_summary"
            rows="4"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="Enter an Arabic summary"
        >{{ old('arabic_summary') }}</textarea>
        @error('arabic_summary')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Play Link -->
    <div class="space-y-1">
        <label for="play_link" class="block font-medium text-gray-700">Play Video Link</label>
        <input
            type="url"
            name="play_link"
            id="play_link"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="https://example.com/your-video"
            value="{{ old('play_link') }}"
            
            title="Please enter a valid URL (e.g. https://youtube.com/watch?v=example)"
            x-on:invalid="$el.setCustomValidity('Please enter a valid URL starting with http:// or https://')"
            x-on:input="$el.setCustomValidity('')"
        >
        <div class="text-xs text-gray-500 mt-1">Must be a valid URL (e.g. https://youtube.com/watch?v=example)</div>
        @error('play_link')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
