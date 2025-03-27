@php
    // We'll convert old('cast_names') to JSON for Alpine initialization
    $oldCastMembers = old('cast_names', []);
    // Create a properly formatted array for Alpine.js
    $castData = [];
    if (is_array($oldCastMembers)) {
        foreach ($oldCastMembers as $index => $name) {
            $castData[] = [
                'name' => $name,
                'role' => old('cast_roles')[$index] ?? '',
            ];
        }
    }
@endphp

<div class="grid gap-4">

    <!-- Contact Name -->
    <div class="space-y-1">
        <label for="contact_name" class="block font-medium text-gray-700">Contact Person Name</label>
        <input
            type="text"
            name="contact_name"
            id="contact_name"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="Enter the primary contact person's name"
            value="{{ old('contact_name') }}"
            required
        >
        @error('contact_name')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Contact Email -->
    <div class="space-y-1">
        <label for="contact_email" class="block font-medium text-gray-700">Contact Email</label>
        <input
            type="email"
            name="contact_email"
            id="contact_email"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="Enter email address (e.g. name@example.com)"
            value="{{ old('contact_email') }}"
            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
            title="Please enter a valid email address (e.g. name@example.com)"
            required
            x-on:invalid="$el.setCustomValidity('Please enter a valid email address (e.g. name@example.com)')"
            x-on:input="$el.setCustomValidity('')"
        >
        <div class="text-xs text-gray-500 mt-1">Must be a valid email address (e.g. name@example.com)</div>
        @error('contact_email')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Contact Phone -->
    <div class="space-y-1">
        <label for="contact_phone" class="block font-medium text-gray-700">Contact Phone</label>
        <input
            type="tel"
            name="contact_phone"
            id="contact_phone"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="Enter phone number (e.g. +1234567890)"
            value="{{ old('contact_phone') }}"
            pattern="^[+]?[0-9]{10,15}$"
            title="Please enter a valid phone number (10-15 digits, may start with +)"
            required
            x-on:invalid="$el.setCustomValidity('Please enter a valid phone number (10-15 digits, may start with +)')"
            x-on:input="$el.setCustomValidity('')"
        >
        <div class="text-xs text-gray-500 mt-1">Must be a valid phone number (10-15 digits, may start with +)</div>
        @error('contact_phone')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Contact Position -->
    <div class="space-y-1">
        <label for="contact_position" class="block font-medium text-gray-700">Position/Role</label>
        <input
            type="text"
            name="contact_position"
            id="contact_position"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="e.g. Director, Producer, Manager"
            value="{{ old('contact_position') }}"
        >
        @error('contact_position')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Actors Count -->
    <div class="space-y-1">
        <label for="actors_count" class="block font-medium text-gray-700">
            Number of Actors / Performers
        </label>
        <input
            type="number"
            name="actors_count"
            id="actors_count"
            min="0"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="e.g. 10"
            value="{{ old('actors_count') }}"
        >
        @error('actors_count')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Cast Members (Dynamic) -->
    <div
        x-data="{
            castMembers: @json($castData),
            addCastMember() {
                this.castMembers.push({
                    name: '',
                    role: ''
                });
            },
            removeCastMember(index) {
                this.castMembers.splice(index, 1);
            }
        }"
        class="space-y-4"
    >
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-700">
                Cast Members
            </h3>
            <button
                type="button"
                @click="addCastMember()"
                class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700"
            >
                + Add Cast Member
            </button>
        </div>

        <!-- Cast Members List -->
        <template x-for="(member, index) in castMembers" :key="index">
            <div class="border border-gray-200 rounded p-4 space-y-2 relative">
                <!-- Remove Button -->
                <button
                    type="button"
                    @click="removeCastMember(index)"
                    class="absolute top-2 right-2 text-red-600 hover:text-red-800"
                >
                    &times;
                </button>

                <!-- Name -->
                <div class="space-y-1">
                    <label :for="'cast_names[' + index + ']'" class="block text-sm font-medium text-gray-700">
                        Name
                    </label>
                    <input
                        type="text"
                        :name="'cast_names[' + index + ']'"
                        :id="'cast_names[' + index + ']'"
                        x-model="member.name"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
                        placeholder="Full name"
                    >
                </div>

                <!-- Role -->
                <div class="space-y-1">
                    <label :for="'cast_roles[' + index + ']'" class="block text-sm font-medium text-gray-700">
                        Role in Play
                    </label>
                    <input
                        type="text"
                        :name="'cast_roles[' + index + ']'"
                        :id="'cast_roles[' + index + ']'"
                        x-model="member.role"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
                        placeholder="e.g. Actor, Stage Manager"
                    >
                </div>
            </div>
        </template>

        @error('cast_names')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
        @error('cast_roles')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
    </div>
</div>
