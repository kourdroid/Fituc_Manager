<div class="grid gap-4">

    <!-- Founded Year -->
    <div class="space-y-1">
        <label for="founded_year" class="block font-medium text-gray-700">Founded Year</label>
        <input
            type="number"
            name="founded_year"
            id="founded_year"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="e.g. 1990"
            min="1900"
            max="2025"
            value="{{ old('founded_year') }}"
        >
        @error('founded_year')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Company Background -->
    <div class="space-y-1">
        <label for="company_background" class="block font-medium text-gray-700">Company Background</label>
        <textarea
            name="company_background"
            id="company_background"
            rows="4"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="Enter background information about your theater company"
        >{{ old('company_background') }}</textarea>
        @error('company_background')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Repertoire Style -->
    <div class="space-y-1">
        <label for="repertoireStyle" class="block font-medium text-gray-700">Repertoire Style</label>
        <input
            type="text"
            name="repertoireStyle"
            id="repertoireStyle"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="e.g. Classical, Modern, Experimental"
            value="{{ old('repertoireStyle') }}"
        >
        @error('repertoireStyle')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Festival Participations (Dynamic) -->
    <div x-data="{
            participations: @json(old('previous_festival', [])),
            addParticipation() {
                this.participations.push({ 
                    festival: '', 
                    year: '', 
                    play: '' 
                });
            },
            removeParticipation(index) {
                this.participations.splice(index, 1);
            }
        }"
        class="space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-700">Festival Participations</h3>
            <button
                type="button"
                @click="addParticipation()"
                class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700"
            >
                + Add Participation
            </button>
        </div>

        <template x-for="(participation, index) in participations" :key="index">
            <div class="border border-gray-200 rounded p-4 space-y-2 relative">
                <button
                    type="button"
                    @click="removeParticipation(index)"
                    class="absolute top-2 right-2 text-red-600 hover:text-red-800"
                >
                    &times;
                </button>

                <!-- Festival Name -->
                <div class="space-y-1">
                    <label :for="'previous_festival[' + index + ']'" class="block text-sm font-medium text-gray-700">
                        Festival Name
                    </label>
                    <input
                        type="text"
                        :name="'previous_festival[' + index + ']'"
                        :id="'previous_festival[' + index + ']'"
                        x-model="participation.festival"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
                        placeholder="Festival name"
                    >
                </div>

                <!-- Year -->
                <div class="space-y-1">
                    <label :for="'previous_year[' + index + ']'" class="block text-sm font-medium text-gray-700">
                        Year
                    </label>
                    <input
                        type="number"
                        :name="'previous_year[' + index + ']'"
                        :id="'previous_year[' + index + ']'"
                        x-model="participation.year"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
                        placeholder="Year of participation"
                        min="1900"
                        max="2025"
                    >
                </div>

                <!-- Play Title -->
                <div class="space-y-1">
                    <label :for="'previous_play[' + index + ']'" class="block text-sm font-medium text-gray-700">
                        Play Title
                    </label>
                    <input
                        type="text"
                        :name="'previous_play[' + index + ']'"
                        :id="'previous_play[' + index + ']'"
                        x-model="participation.play"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
                        placeholder="Title of play presented"
                    >
                </div>
            </div>
        </template>

        @error('previous_festival')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
        @error('previous_year')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
        @error('previous_play')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <!-- Already Played (Radio Buttons) -->
    <div class="space-y-1">
        <label class="block font-medium text-gray-700">Already Played?</label>
        <div class="flex items-center gap-4">
            <label class="inline-flex items-center">
                <input
                    type="radio"
                    name="alreadyPlayed"
                    value="yes"
                    class="form-radio"
                    {{ old('alreadyPlayed') === 'yes' ? 'checked' : '' }}
                >
                <span class="ml-2">Yes</span>
            </label>
            <label class="inline-flex items-center">
                <input
                    type="radio"
                    name="alreadyPlayed"
                    value="no"
                    class="form-radio"
                    {{ old('alreadyPlayed', 'no') === 'no' ? 'checked' : '' }}
                >
                <span class="ml-2">No</span>
            </label>
        </div>
        @error('alreadyPlayed')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Previous Performances (Dynamic) -->
    <div x-data="{
            previous: @json(old('previousPerformances', [])),
            addPrevious() {
                this.previous.push({ number: '', place: '', date: '' });
            },
            removePrevious(index) {
                this.previous.splice(index, 1);
            }
        }"
        class="space-y-4"
    >
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-700">Previous Performances</h3>
            <button
                type="button"
                @click="addPrevious()"
                class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700"
            >
                + Add Previous
            </button>
        </div>
        <template x-for="(perf, index) in previous" :key="index">
            <div class="border border-gray-200 rounded p-4 space-y-2 relative">
                <button
                    type="button"
                    @click="removePrevious(index)"
                    class="absolute top-2 right-2 text-red-600 hover:text-red-800"
                >
                    &times;
                </button>
                <!-- Performance Number -->
                <div class="space-y-1">
                    <label :for="'previousPerformances[' + index + '][number]'" class="block text-sm font-medium text-gray-700">
                        Performance Number
                    </label>
                    <input
                        type="text"
                        :name="'previousPerformances[' + index + '][number]'"
                        :id="'previousPerformances[' + index + '][number]'"
                        x-model="perf.number"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
                        placeholder="e.g. 1"
                    >
                </div>
                <!-- Place -->
                <div class="space-y-1">
                    <label :for="'previousPerformances[' + index + '][place]'" class="block text-sm font-medium text-gray-700">
                        Place
                    </label>
                    <input
                        type="text"
                        :name="'previousPerformances[' + index + '][place]'"
                        :id="'previousPerformances[' + index + '][place]'"
                        x-model="perf.place"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
                        placeholder="Venue or city"
                    >
                </div>
                <!-- Date -->
                <div class="space-y-1">
                    <label :for="'previousPerformances[' + index + '][date]'" class="block text-sm font-medium text-gray-700">
                        Date
                    </label>
                    <input
                        type="date"
                        :name="'previousPerformances[' + index + '][date]'"
                        :id="'previousPerformances[' + index + '][date]'"
                        x-model="perf.date"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
                    >
                </div>
            </div>
        </template>
        @error('previousPerformances')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <!-- Upcoming Performances (Dynamic) -->
    <div x-data="{
            upcoming: @json(old('upcomingPerformances', [])),
            addUpcoming() {
                this.upcoming.push({ date: '', place: '' });
            },
            removeUpcoming(index) {
                this.upcoming.splice(index, 1);
            }
        }"
        class="space-y-4"
    >
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-700">Upcoming Performances</h3>
            <button
                type="button"
                @click="addUpcoming()"
                class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700"
            >
                + Add Upcoming
            </button>
        </div>
        <template x-for="(up, index) in upcoming" :key="index">
            <div class="border border-gray-200 rounded p-4 space-y-2 relative">
                <button
                    type="button"
                    @click="removeUpcoming(index)"
                    class="absolute top-2 right-2 text-red-600 hover:text-red-800"
                >
                    &times;
                </button>
                <!-- Date -->
                <div class="space-y-1">
                    <label :for="'upcomingPerformances[' + index + '][date]'" class="block text-sm font-medium text-gray-700">
                        Date
                    </label>
                    <input
                        type="date"
                        :name="'upcomingPerformances[' + index + '][date]'"
                        :id="'upcomingPerformances[' + index + '][date]'"
                        x-model="up.date"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
                    >
                </div>
                <!-- Place -->
                <div class="space-y-1">
                    <label :for="'upcomingPerformances[' + index + '][place]'" class="block text-sm font-medium text-gray-700">
                        Place
                    </label>
                    <input
                        type="text"
                        :name="'upcomingPerformances[' + index + '][place]'"
                        :id="'upcomingPerformances[' + index + '][place]'"
                        x-model="up.place"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
                        placeholder="Venue or city"
                    >
                </div>
            </div>
        </template>
        @error('upcomingPerformances')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
    </div>

</div>
