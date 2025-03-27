<div class="space-y-8">
    <!-- Photographs of the Play -->
    <div class="space-y-2">
        <h3 class="text-lg font-semibold">Photographs of the Play</h3>
        <p class="text-sm text-gray-500">
            Please upload photographs of the proposed play (copyright free).
        </p>

        <div
            x-data="{
                isDragging: false,
                handleDragOver(e) {
                    e.preventDefault();
                    this.isDragging = true;
                },
                handleDragLeave(e) {
                    e.preventDefault();
                    this.isDragging = false;
                },
                handleDrop(e) {
                    e.preventDefault();
                    this.isDragging = false;
                    // If you want to handle files immediately:
                    // let files = e.dataTransfer.files;
                    // $refs.photosInput.files = files;
                    // (But typically, you'd just let the user choose or drag, then submit the form.)
                }
            }"
            class="relative border-2 border-dashed border-gray-300 rounded-md p-6 text-center
                   transition-all duration-200 hover:border-gray-400 flex flex-col items-center justify-center
                   cursor-pointer"
            :class="isDragging ? 'bg-gray-50 border-blue-400' : ''"
            @dragover="handleDragOver"
            @dragleave="handleDragLeave"
            @drop="handleDrop"
            @click="$refs.photosInput.click()"
        >
            <!-- Icon (optional) -->
            <svg
                class="w-10 h-10 text-gray-400 mb-2"
                fill="none" stroke="currentColor" stroke-width="1.5"
                viewBox="0 0 24 24"
            >
                <path
                    d="M12 12v.01M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M8 16v-6a4 4 0 018 0v6"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>

            <p class="text-sm text-gray-500">
                Drag and drop your files here <br>
                or click the button below to browse your files
            </p>

            <!-- Hidden file input -->
            <input
                x-ref="photosInput"
                type="file"
                name="photos[]"
                id="photos"
                multiple
                accept="image/*"
                class="hidden"
            >

            <!-- Upload Button (alternative to clicking the dropzone) -->
            <button
                type="button"
                class="mt-3 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                @click.stop="$refs.photosInput.click()"
            >
                Upload Photos
            </button>
        </div>
        @error('photos')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Press Reviews -->
    <div class="space-y-2">
        <h3 class="text-lg font-semibold">Press Reviews</h3>
        <p class="text-sm text-gray-500">
            Please upload press reviews on the proposed play if available.
        </p>

        <div
            x-data="{
                isDragging: false,
                handleDragOver(e) {
                    e.preventDefault();
                    this.isDragging = true;
                },
                handleDragLeave(e) {
                    e.preventDefault();
                    this.isDragging = false;
                },
                handleDrop(e) {
                    e.preventDefault();
                    this.isDragging = false;
                    // let files = e.dataTransfer.files;
                    // $refs.pressReviewsInput.files = files;
                }
            }"
            class="relative border-2 border-dashed border-gray-300 rounded-md p-6 text-center
                   transition-all duration-200 hover:border-gray-400 flex flex-col items-center justify-center
                   cursor-pointer"
            :class="isDragging ? 'bg-gray-50 border-blue-400' : ''"
            @dragover="handleDragOver"
            @dragleave="handleDragLeave"
            @drop="handleDrop"
            @click="$refs.pressReviewsInput.click()"
        >
            <svg
                class="w-10 h-10 text-gray-400 mb-2"
                fill="none" stroke="currentColor" stroke-width="1.5"
                viewBox="0 0 24 24"
            >
                <path
                    d="M12 12v.01M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M8 16v-6a4 4 0 018 0v6"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>

            <p class="text-sm text-gray-500">
                Drag and drop your files here <br>
                or click the button below to browse your files
            </p>

            <input
                x-ref="pressReviewsInput"
                type="file"
                name="pressReviews[]"
                id="pressReviews"
                multiple
                accept=".pdf,.doc,.docx"
                class="hidden"
            >

            <button
                type="button"
                class="mt-3 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                @click.stop="$refs.pressReviewsInput.click()"
            >
                Upload Press Reviews
            </button>
        </div>
        @error('pressReviews')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Posters -->
    <div class="space-y-2">
        <h3 class="text-lg font-semibold">Posters</h3>
        <p class="text-sm text-gray-500">
            Please upload posters of the proposed play if available.
        </p>

        <div
            x-data="{
                isDragging: false,
                handleDragOver(e) {
                    e.preventDefault();
                    this.isDragging = true;
                },
                handleDragLeave(e) {
                    e.preventDefault();
                    this.isDragging = false;
                },
                handleDrop(e) {
                    e.preventDefault();
                    this.isDragging = false;
                    // let files = e.dataTransfer.files;
                    // $refs.postersInput.files = files;
                }
            }"
            class="relative border-2 border-dashed border-gray-300 rounded-md p-6 text-center
                   transition-all duration-200 hover:border-gray-400 flex flex-col items-center justify-center
                   cursor-pointer"
            :class="isDragging ? 'bg-gray-50 border-blue-400' : ''"
            @dragover="handleDragOver"
            @dragleave="handleDragLeave"
            @drop="handleDrop"
            @click="$refs.postersInput.click()"
        >
            <svg
                class="w-10 h-10 text-gray-400 mb-2"
                fill="none" stroke="currentColor" stroke-width="1.5"
                viewBox="0 0 24 24"
            >
                <path
                    d="M12 12v.01M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M8 16v-6a4 4 0 018 0v6"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>

            <p class="text-sm text-gray-500">
                Drag and drop your files here <br>
                or click the button below to browse your files
            </p>

            <input
                x-ref="postersInput"
                type="file"
                name="posters[]"
                id="posters"
                multiple
                accept="image/*,application/pdf"
                class="hidden"
            >

            <button
                type="button"
                class="mt-3 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                @click.stop="$refs.postersInput.click()"
            >
                Upload Posters
            </button>
        </div>
        @error('posters')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
