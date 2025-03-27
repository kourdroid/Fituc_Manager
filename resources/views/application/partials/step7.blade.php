<div class="space-y-8">
    <!-- Basic Information -->
    <div>
        <h3 class="text-lg font-semibold mb-2">Basic Information</h3>
        <div class="text-sm text-gray-700 space-y-1">
            <p><strong>Country:</strong> {{ old('country') }}</p>
            <p><strong>Company Name:</strong> {{ old('companyName') }}</p>
            <p><strong>University:</strong> {{ old('university') }}</p>
            <p><strong>Play Title:</strong> {{ old('playTitle') }}</p>
            <p><strong>Director:</strong> {{ old('director') }}</p>
            <p><strong>Author:</strong> {{ old('author') }}</p>
            <p><strong>Duration:</strong> {{ old('duration') }} minutes</p>
        </div>
    </div>

    <!-- Play Summary -->
    <div>
        <h3 class="text-lg font-semibold mb-2">Play Summary</h3>
        <div class="text-sm text-gray-700 space-y-1">
            <p><strong>Summary (Original):</strong> {{ old('summarySummary') }}</p>
            <p><strong>Summary (English):</strong> {{ old('summaryEnglish') }}</p>
            <p><strong>Summary (French):</strong> {{ old('summaryFrench') }}</p>
            <p><strong>Summary (Arabic):</strong> {{ old('summaryArabic') }}</p>
            <p><strong>Play Link:</strong> {{ old('playLink') }}</p>
        </div>
    </div>

    <!-- Troop Information -->
    <div>
        <h3 class="text-lg font-semibold mb-2">Troop Information</h3>
        <div class="text-sm text-gray-700 space-y-1">
            <p><strong>Number of Actors / Performers:</strong> {{ old('actorsCount') }}</p>

            @php
                $participants = old('participants', []);
            @endphp
            @if(is_array($participants) && count($participants))
                <div class="mt-2">
                    <p class="font-semibold">Participants:</p>
                    <ul class="list-disc list-inside">
                        @foreach($participants as $index => $participant)
                            <li class="ml-4">
                                <p><strong>Name:</strong> {{ $participant['name'] ?? '' }}</p>
                                <p><strong>Passport ID:</strong> {{ $participant['passportId'] ?? '' }}</p>
                                <p><strong>Age:</strong> {{ $participant['age'] ?? '' }}</p>
                                <p><strong>Role:</strong> {{ $participant['role'] ?? '' }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    <!-- Company Background -->
    <div>
        <h3 class="text-lg font-semibold mb-2">Company Background</h3>
        <div class="text-sm text-gray-700 space-y-1">
            <p><strong>Company Origin:</strong> {{ old('companyOrigin') }}</p>
            <p><strong>Repertoire Style:</strong> {{ old('repertoireStyle') }}</p>

            @php
                $festivalParticipations = old('festivalParticipations', []);
            @endphp
            @if(is_array($festivalParticipations) && count($festivalParticipations))
                <div class="mt-2">
                    <p class="font-semibold">Festival Participations:</p>
                    <ul class="list-disc list-inside">
                        @foreach($festivalParticipations as $index => $item)
                            <li class="ml-4">
                                <p><strong>Event Name:</strong> {{ $item['eventName'] ?? '' }}</p>
                                <p><strong>Play Title:</strong> {{ $item['playTitle'] ?? '' }}</p>
                                <p><strong>Country:</strong> {{ $item['country'] ?? '' }}</p>
                                <p><strong>Prizes:</strong> {{ $item['prizes'] ?? '' }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <p><strong>Already Played?</strong> {{ old('alreadyPlayed') }}</p>

            @php
                $previousPerformances = old('previousPerformances', []);
            @endphp
            @if(is_array($previousPerformances) && count($previousPerformances))
                <div class="mt-2">
                    <p class="font-semibold">Previous Performances:</p>
                    <ul class="list-disc list-inside">
                        @foreach($previousPerformances as $index => $perf)
                            <li class="ml-4">
                                <p><strong>Number:</strong> {{ $perf['number'] ?? '' }}</p>
                                <p><strong>Place:</strong> {{ $perf['place'] ?? '' }}</p>
                                <p><strong>Date:</strong> {{ $perf['date'] ?? '' }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @php
                $upcomingPerformances = old('upcomingPerformances', []);
            @endphp
            @if(is_array($upcomingPerformances) && count($upcomingPerformances))
                <div class="mt-2">
                    <p class="font-semibold">Upcoming Performances:</p>
                    <ul class="list-disc list-inside">
                        @foreach($upcomingPerformances as $index => $up)
                            <li class="ml-4">
                                <p><strong>Date:</strong> {{ $up['date'] ?? '' }}</p>
                                <p><strong>Place:</strong> {{ $up['place'] ?? '' }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    <!-- Technical Requirements -->
    <div>
        <h3 class="text-lg font-semibold mb-2">Technical Requirements</h3>
        <div class="text-sm text-gray-700 space-y-1">
            <p><strong>Technical Description:</strong> {{ old('technicalDescription') }}</p>
            <p><strong>Stage Dimensions:</strong> {{ old('dimensions') }}</p>
            <p><strong>Assembling Time:</strong> {{ old('assemblingTime') }} minutes</p>
            <p><strong>Disassembly Time:</strong> {{ old('disassemblyTime') }} minutes</p>
            <p><strong>Costumes:</strong> {{ old('costumes') }}</p>
            <p><strong>Accessories:</strong> {{ old('accessories') }}</p>
            <p><strong>Lighting Plan:</strong> {{ old('lightingPlan') }}</p>
            <p><strong>Sound Requirements:</strong> {{ old('soundRequirements') }}</p>
        </div>
    </div>

    <!-- Attachments -->
    <div>
        <h3 class="text-lg font-semibold mb-2">Attachments</h3>
        <div class="text-sm text-gray-700 space-y-1">
            <p>
                <strong>Photos:</strong>
                {{-- Files won't persist in old() after a failed validation unless you handle them differently --}}
                @if(old('photos'))
                    ({{ count(old('photos')) }} files selected)
                @else
                    None
                @endif
            </p>
            <p>
                <strong>Press Reviews:</strong>
                @if(old('pressReviews'))
                    ({{ count(old('pressReviews')) }} files selected)
                @else
                    None
                @endif
            </p>
            <p>
                <strong>Posters:</strong>
                @if(old('posters'))
                    ({{ count(old('posters')) }} files selected)
                @else
                    None
                @endif
            </p>
        </div>
    </div>

    <!-- Final Notice -->
    <div class="bg-blue-50 border border-blue-200 rounded p-4">
        <p class="text-gray-700 text-sm">
            Please review your information carefully. If everything is correct, click <strong>Submit</strong> to finalize your application. Otherwise, use the <strong>Previous</strong> button to go back and make changes.
        </p>
    </div>
</div>
