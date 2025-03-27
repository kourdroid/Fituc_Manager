{{-- resources/views/application/partials/step1.blade.php --}}
<div class="grid gap-4">
    <!-- Country -->
    <div class="space-y-1">
        <label for="country" class="block font-medium text-gray-700">Country</label>
        <input
            type="text"
            name="country"
            id="country"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="Enter your country"
            value="{{ old('country') }}"
            required
        >
        @error('country')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Troupe Name -->
    <div class="space-y-1">
        <label for="troupe_name" class="block font-medium text-gray-700">Troupe Name</label>
        <input
            type="text"
            name="troupe_name"
            id="troupe_name"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="Enter your troupe name"
            value="{{ old('troupe_name') }}"
            required
        >
        @error('troupe_name')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- University -->
    <div class="space-y-1">
        <label for="university" class="block font-medium text-gray-700">University</label>
        <input
            type="text"
            name="university"
            id="university"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="Enter your university"
            value="{{ old('university') }}"
            required
        >
        @error('university')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Play Title -->
    <div class="space-y-1">
        <label for="play_title" class="block font-medium text-gray-700">Play Title</label>
        <input
            type="text"
            name="play_title"
            id="play_title"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="Enter your play title"
            value="{{ old('play_title') }}"
            required
        >
        @error('play_title')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Director -->
    <div class="space-y-1">
        <label for="director" class="block font-medium text-gray-700">Director</label>
        <input
            type="text"
            name="director"
            id="director"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="Enter the director's name"
            value="{{ old('director') }}"
            required
        >
        @error('director')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Author -->
    <div class="space-y-1">
        <label for="author" class="block font-medium text-gray-700">Author</label>
        <input
            type="text"
            name="author"
            id="author"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="Enter the author"
            value="{{ old('author') }}"
            required
        >
        @error('author')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Duration -->
    <div class="space-y-1">
        <label for="duration" class="block font-medium text-gray-700">Duration (in minutes)</label>
        <input
            type="number"
            name="duration"
            id="duration"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="e.g. 90"
            value="{{ old('duration') }}"
            min="1"
            max="180"
            required
        >
        @error('duration')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Summary -->
    <div class="space-y-1">
        <label for="summary" class="block font-medium text-gray-700">Play Summary</label>
        <textarea
            name="summary"
            id="summary"
            rows="4"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="Enter a brief summary of your play"
            required
        >{{ old('summary') }}</textarea>
        <div class="text-xs text-gray-500 mt-1">Please provide a brief summary of your play (required)</div>
        @error('summary')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
