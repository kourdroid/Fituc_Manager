<div class="grid gap-4">

    <!-- Staging Type -->
    <div class="space-y-1">
        <label for="staging_type" class="block font-medium text-gray-700">
            Staging Type
        </label>
        <select
            name="staging_type"
            id="staging_type"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
        >
            <option value="" disabled selected>Select staging type</option>
            <option value="proscenium" {{ old('staging_type') == 'proscenium' ? 'selected' : '' }}>Proscenium</option>
            <option value="thrust" {{ old('staging_type') == 'thrust' ? 'selected' : '' }}>Thrust</option>
            <option value="arena" {{ old('staging_type') == 'arena' ? 'selected' : '' }}>Arena/Theatre in the Round</option>
            <option value="black_box" {{ old('staging_type') == 'black_box' ? 'selected' : '' }}>Black Box</option>
            <option value="site_specific" {{ old('staging_type') == 'site_specific' ? 'selected' : '' }}>Site-Specific</option>
            <option value="other" {{ old('staging_type') == 'other' ? 'selected' : '' }}>Other</option>
        </select>
        @error('staging_type')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Special Requirements -->
    <div class="space-y-1">
        <label for="special_requirements" class="block font-medium text-gray-700">
            Special Requirements
        </label>
        <textarea
            name="special_requirements"
            id="special_requirements"
            rows="4"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="Describe any special requirements or setup needed for your production"
        >{{ old('special_requirements') }}</textarea>
        @error('special_requirements')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Technical Notes -->
    <div class="space-y-1">
        <label for="technical_notes" class="block font-medium text-gray-700">
            Technical Notes
        </label>
        <textarea
            name="technical_notes"
            id="technical_notes"
            rows="4"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="Additional technical information, including lighting, sound, or stage requirements"
        >{{ old('technical_notes') }}</textarea>
        @error('technical_notes')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- File Attachments Section -->
    <div x-data="{
        attachments: [],
        addAttachment() {
            this.attachments.push({ file: null, type: 'document', filename: '' });
        },
        removeAttachment(index) {
            this.attachments.splice(index, 1);
        },
        updateFilename(event, index) {
            if (event.target.files.length > 0) {
                this.attachments[index].filename = event.target.files[0].name;
            }
        }
    }" class="space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-700">Attachments</h3>
            <button 
                type="button"
                @click="addAttachment()"
                class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700"
            >
                + Add Attachment
            </button>
        </div>

        <template x-for="(attachment, index) in attachments" :key="index">
            <div class="border border-gray-200 rounded p-4 space-y-3 relative">
                <button
                    type="button"
                    @click="removeAttachment(index)"
                    class="absolute top-2 right-2 text-red-600 hover:text-red-800"
                >
                    &times;
                </button>

                <!-- File Input -->
                <div class="space-y-1">
                    <label :for="'attachments_' + index" class="block text-sm font-medium text-gray-700">
                        File
                    </label>
                    <input
                        type="file"
                        :name="'attachments[' + index + ']'"
                        :id="'attachments_' + index"
                        @change="updateFilename($event, index)"
                        class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100"
                    >
                    <p x-text="attachment.filename" class="text-sm text-gray-500 mt-1"></p>
                </div>

                <!-- Attachment Type -->
                <div class="space-y-1">
                    <label :for="'attachment_types_' + index" class="block text-sm font-medium text-gray-700">
                        Type
                    </label>
                    <select
                        :name="'attachment_types[' + index + ']'"
                        :id="'attachment_types_' + index"
                        x-model="attachment.type"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
                    >
                        <option value="document">Document</option>
                        <option value="image">Image</option>
                        <option value="script">Script</option>
                        <option value="stage_plan">Stage Plan</option>
                        <option value="technical_rider">Technical Rider</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>
        </template>

        @error('attachments')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
        @error('attachment_types')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
    </div>
</div>
