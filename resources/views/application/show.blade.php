<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Application Details') }}
            </h2>
            <a href="{{ route('application.index') }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 border border-gray-300 bg-white hover:bg-gray-50 h-9 px-4 py-2 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-md" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Application Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $application->play_title }}</h1>
                            <p class="text-gray-500 mt-1">{{ $application->troupe_name }} from {{ $application->country }}</p>
                        </div>
                        <div class="mt-4 md:mt-0 flex flex-col items-start md:items-end">
                            <div class="flex items-center space-x-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($application->status === 'submitted') bg-blue-100 text-blue-800
                                    @elseif($application->status === 'under_review') bg-yellow-100 text-yellow-800
                                    @elseif($application->status === 'approved') bg-green-100 text-green-800
                                    @elseif($application->status === 'rejected') bg-red-100 text-red-800
                                    @endif
                                ">
                                    {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                                </span>
                                <span class="text-sm text-gray-500">Submitted {{ $application->created_at->format('M d, Y') }}</span>
                            </div>
                            
                            <!-- Status Update Dropdown -->
                            <form action="{{ route('application.status.update', $application->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('PATCH')
                                <div class="flex items-center space-x-2">
                                    <label for="status" class="text-sm text-gray-500">Change status:</label>
                                    <select name="status" id="status" onchange="this.form.submit()" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                                        <option value="submitted" {{ $application->status === 'submitted' ? 'selected' : '' }}>Submitted</option>
                                        <option value="under_review" {{ $application->status === 'under_review' ? 'selected' : '' }}>Under Review</option>
                                        <option value="approved" {{ $application->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>
                            </form>
                            
                            <!-- Approval/Decline Buttons -->
                            <div class="flex space-x-2 mt-3">
                                @if($application->status !== 'approved')
                                <form action="{{ route('application.status.update', $application->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-green-600 text-white hover:bg-green-700 h-9 px-4 py-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Approve
                                    </button>
                                </form>
                                @endif
                                
                                @if($application->status !== 'rejected')
                                <form action="{{ route('application.status.update', $application->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-red-600 text-white hover:bg-red-700 h-9 px-4 py-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Decline
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Application Content -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="md:col-span-2 space-y-6">
                    <!-- Play Details -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="border-b border-gray-200 bg-gray-50">
                            <div class="px-6 py-3">
                                <h3 class="text-lg font-medium text-gray-900">Play Details</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Play Title</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->play_title }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Author</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->author }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Director</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->director }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Duration</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->duration }} minutes</dd>
                                </div>
                                <div class="md:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">Play Summary</dt>
                                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $application->summary }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Basic Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="border-b border-gray-200 bg-gray-50">
                            <div class="px-6 py-3">
                                <h3 class="text-lg font-medium text-gray-900">Basic Information</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Country</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->country }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">University</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->university }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Troupe Name</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->troupe_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Submission Date</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->created_at->format('M d, Y') }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Play Details -->
                    @if($application->playDetail)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="border-b border-gray-200 bg-gray-50">
                            <div class="px-6 py-3">
                                <h3 class="text-lg font-medium text-gray-900">Play Details</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Language</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->playDetail->language }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Premiere Date</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->playDetail->premiere_date ? \Carbon\Carbon::parse($application->playDetail->premiere_date)->format('M d, Y') : 'N/A' }}</dd>
                                </div>
                                <div class="md:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">English Summary</dt>
                                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $application->playDetail->english_summary }}</dd>
                                </div>
                                <div class="md:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">French Summary</dt>
                                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $application->playDetail->french_summary }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                    @endif

                    <!-- Company Information -->
                    @if($application->companyInfo)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="border-b border-gray-200 bg-gray-50">
                            <div class="px-6 py-3">
                                <h3 class="text-lg font-medium text-gray-900">Company Information</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Founded Year</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->companyInfo->founded_year }}</dd>
                                </div>
                                <div class="md:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">Background</dt>
                                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $application->companyInfo->background }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                    @endif

                    <!-- Contact Information -->
                    @if($application->contact)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="border-b border-gray-200 bg-gray-50">
                            <div class="px-6 py-3">
                                <h3 class="text-lg font-medium text-gray-900">Contact Information</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Name</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->contact->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Position</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->contact->position }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <a href="mailto:{{ $application->contact->email }}" class="text-indigo-600 hover:text-indigo-900">
                                            {{ $application->contact->email }}
                                        </a>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Phone</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <a href="tel:{{ $application->contact->phone }}" class="text-indigo-600 hover:text-indigo-900">
                                            {{ $application->contact->phone }}
                                        </a>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                    @endif

                    <!-- Technical Details -->
                    @if($application->technicalDetail)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="border-b border-gray-200 bg-gray-50">
                            <div class="px-6 py-3">
                                <h3 class="text-lg font-medium text-gray-900">Technical Details</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <dl class="grid grid-cols-1 gap-y-6">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Staging Type</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->technicalDetail->staging_type }}</dd>
                                </div>
                                <div class="md:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">Special Requirements</dt>
                                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $application->technicalDetail->special_requirements }}</dd>
                                </div>
                                <div class="md:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">Technical Notes</dt>
                                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $application->technicalDetail->technical_notes }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                    @endif

                    <!-- Cast Members -->
                    @if($application->castMembers->count() > 0)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="border-b border-gray-200 bg-gray-50">
                            <div class="px-6 py-3">
                                <h3 class="text-lg font-medium text-gray-900">Cast Members</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($application->castMembers as $castMember)
                                        <tr>
                                            <td class="px-4 py-3">{{ $castMember->name }}</td>
                                            <td class="px-4 py-3">{{ $castMember->role }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Participation History -->
                    @if($application->participationHistories->count() > 0)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="border-b border-gray-200 bg-gray-50">
                            <div class="px-6 py-3">
                                <h3 class="text-lg font-medium text-gray-900">Festival Participation History</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Festival</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Play</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($application->participationHistories as $history)
                                        <tr>
                                            <td class="px-4 py-3">{{ $history->festival_name }}</td>
                                            <td class="px-4 py-3">{{ $history->year }}</td>
                                            <td class="px-4 py-3">{{ $history->play_title }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Attachments -->
                    @if($application->attachments->count() > 0)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="border-b border-gray-200 bg-gray-50">
                            <div class="px-6 py-3">
                                <h3 class="text-lg font-medium text-gray-900">Attachments</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="grid md:grid-cols-2 gap-4">
                                @foreach($application->attachments as $attachment)
                                <div class="border p-4 rounded">
                                    <p class="font-medium">{{ $attachment->original_filename }}</p>
                                    <p class="text-sm text-gray-500">Type: {{ ucfirst($attachment->file_type) }}</p>
                                    <a href="{{ Storage::url($attachment->file_path) }}" class="text-blue-600 hover:underline text-sm" target="_blank">
                                        Download / View
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Troupe Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="border-b border-gray-200 bg-gray-50">
                            <div class="px-6 py-3">
                                <h3 class="text-lg font-medium text-gray-900">Troupe Information</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <dl class="space-y-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Troupe Name</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->troupe_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">University</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->university }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Country</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->country }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Number of Participants</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->participant_count }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="border-b border-gray-200 bg-gray-50">
                            <div class="px-6 py-3">
                                <h3 class="text-lg font-medium text-gray-900">Contact Information</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <dl class="space-y-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Contact Person</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->contact_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <a href="mailto:{{ $application->contact_email }}" class="text-indigo-600 hover:text-indigo-900">
                                            {{ $application->contact_email }}
                                        </a>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Phone</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <a href="tel:{{ $application->contact_phone }}" class="text-indigo-600 hover:text-indigo-900">
                                            {{ $application->contact_phone }}
                                        </a>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Attachments -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="border-b border-gray-200 bg-gray-50">
                            <div class="px-6 py-3">
                                <h3 class="text-lg font-medium text-gray-900">Attachments</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            @if(count($application->attachments) > 0)
                                <ul class="space-y-2">
                                    @foreach($application->attachments as $attachment)
                                        <li>
                                            <a href="{{ Storage::url($attachment->file_path) }}" 
                                               class="flex items-center text-sm text-indigo-600 hover:text-indigo-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                                </svg>
                                                {{ $attachment->original_name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-sm text-gray-500">No attachments provided</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Application -->
    <div class="flex justify-end mt-8">
        <form action="{{ route('application.destroy', $application->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this application? This action cannot be undone.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Delete Application
            </button>
        </form>
    </div>
</x-app-layout>
