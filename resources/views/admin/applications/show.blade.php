<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Application Details') }}
            </h2>
            <a href="{{ route('application.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded inline-flex items-center">
                <span>Back to List</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Status Update Form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Update Application Status</h3>
                    
                    <form action="{{ route('application.status.update', $application->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="submitted" {{ $application->status === 'submitted' ? 'selected' : '' }}>Submitted</option>
                                    <option value="under_review" {{ $application->status === 'under_review' ? 'selected' : '' }}>Under Review</option>
                                    <option value="approved" {{ $application->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>
                            
                            <div class="md:col-span-2">
                                <label for="feedback" class="block text-sm font-medium text-gray-700">Feedback (Optional)</label>
                                <textarea id="feedback" name="feedback" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ $application->feedback }}</textarea>
                                <p class="mt-1 text-sm text-gray-500">This feedback will be visible to the applicant</p>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Update Status
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Application Details -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Basic Information -->
                        <div class="col-span-1 md:col-span-3">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Troupe Name</p>
                                    <p class="mt-1">{{ $application->troupe_name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Play Title</p>
                                    <p class="mt-1">{{ $application->play_title }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Author</p>
                                    <p class="mt-1">{{ $application->author }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Director</p>
                                    <p class="mt-1">{{ $application->director }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Country</p>
                                    <p class="mt-1">{{ $application->country }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">University</p>
                                    <p class="mt-1">{{ $application->university }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Duration (minutes)</p>
                                    <p class="mt-1">{{ $application->duration }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Submitted By</p>
                                    <p class="mt-1">{{ $application->user->name }} ({{ $application->user->email }})</p>
                                </div>
                            </div>
                        </div>

                        <!-- Play Summary -->
                        <div class="col-span-1 md:col-span-3">
                            <h4 class="text-md font-medium text-gray-900 mb-2">Play Summary</h4>
                            <p class="text-gray-700 whitespace-pre-line">{{ $application->summary }}</p>
                        </div>

                        <!-- Contact Information -->
                        @if($application->contact)
                        <div class="col-span-1 md:col-span-3">
                            <h3 class="text-lg font-medium text-gray-900 mb-4 mt-6">Contact Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Contact Name</p>
                                    <p class="mt-1">{{ $application->contact->name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Position</p>
                                    <p class="mt-1">{{ $application->contact->position }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Email</p>
                                    <p class="mt-1">{{ $application->contact->email }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Phone</p>
                                    <p class="mt-1">{{ $application->contact->phone }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Play Details -->
                        @if($application->playDetail)
                        <div class="col-span-1 md:col-span-3">
                            <h3 class="text-lg font-medium text-gray-900 mb-4 mt-6">Play Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Language</p>
                                    <p class="mt-1">{{ $application->playDetail->language }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Premiere Date</p>
                                    <p class="mt-1">{{ $application->playDetail->premiere_date ? date('F j, Y', strtotime($application->playDetail->premiere_date)) : 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Play Link</p>
                                    <p class="mt-1">
                                        @if($application->playDetail->play_link)
                                            <a href="{{ $application->playDetail->play_link }}" target="_blank" class="text-blue-600 hover:underline">{{ $application->playDetail->play_link }}</a>
                                        @else
                                            N/A
                                        @endif
                                    </p>
                                </div>
                            </div>

                            @if($application->playDetail->english_summary)
                            <div class="mt-4">
                                <p class="text-sm font-medium text-gray-500">English Summary</p>
                                <p class="mt-1 text-gray-700 whitespace-pre-line">{{ $application->playDetail->english_summary }}</p>
                            </div>
                            @endif

                            @if($application->playDetail->french_summary)
                            <div class="mt-4">
                                <p class="text-sm font-medium text-gray-500">French Summary</p>
                                <p class="mt-1 text-gray-700 whitespace-pre-line">{{ $application->playDetail->french_summary }}</p>
                            </div>
                            @endif

                            @if($application->playDetail->arabic_summary)
                            <div class="mt-4">
                                <p class="text-sm font-medium text-gray-500">Arabic Summary</p>
                                <p class="mt-1 text-gray-700 whitespace-pre-line">{{ $application->playDetail->arabic_summary }}</p>
                            </div>
                            @endif
                        </div>
                        @endif

                        <!-- Company Information -->
                        @if($application->companyInfo)
                        <div class="col-span-1 md:col-span-3">
                            <h3 class="text-lg font-medium text-gray-900 mb-4 mt-6">Company Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Founded Year</p>
                                    <p class="mt-1">{{ $application->companyInfo->founded_year ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Repertoire Style</p>
                                    <p class="mt-1">{{ $application->companyInfo->repertoire_style ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Already Played</p>
                                    <p class="mt-1">{{ $application->companyInfo->already_played ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Number of Actors</p>
                                    <p class="mt-1">{{ $application->companyInfo->actors_count ?? 'N/A' }}</p>
                                </div>
                            </div>

                            @if($application->companyInfo->background)
                            <div class="mt-4">
                                <p class="text-sm font-medium text-gray-500">Company Background</p>
                                <p class="mt-1 text-gray-700 whitespace-pre-line">{{ $application->companyInfo->background }}</p>
                            </div>
                            @endif
                        </div>
                        @endif

                        <!-- Technical Details -->
                        @if($application->technicalDetail)
                        <div class="col-span-1 md:col-span-3">
                            <h3 class="text-lg font-medium text-gray-900 mb-4 mt-6">Technical Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Staging Type</p>
                                    <p class="mt-1">{{ $application->technicalDetail->staging_type ?? 'N/A' }}</p>
                                </div>
                            </div>

                            @if($application->technicalDetail->special_requirements)
                            <div class="mt-4">
                                <p class="text-sm font-medium text-gray-500">Special Requirements</p>
                                <p class="mt-1 text-gray-700 whitespace-pre-line">{{ $application->technicalDetail->special_requirements }}</p>
                            </div>
                            @endif

                            @if($application->technicalDetail->technical_notes)
                            <div class="mt-4">
                                <p class="text-sm font-medium text-gray-500">Technical Notes</p>
                                <p class="mt-1 text-gray-700 whitespace-pre-line">{{ $application->technicalDetail->technical_notes }}</p>
                            </div>
                            @endif
                        </div>
                        @endif

                        <!-- Cast Members -->
                        @if(count($application->castMembers) > 0)
                        <div class="col-span-1 md:col-span-3">
                            <h3 class="text-lg font-medium text-gray-900 mb-4 mt-6">Cast Members</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($application->castMembers as $castMember)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $castMember->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $castMember->role ?? 'N/A' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif

                        <!-- Participation History -->
                        @if(count($application->participationHistories) > 0)
                        <div class="col-span-1 md:col-span-3">
                            <h3 class="text-lg font-medium text-gray-900 mb-4 mt-6">Participation History</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Festival</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Play</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($application->participationHistories as $history)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $history->festival_name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $history->year ?? 'N/A' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $history->play_title ?? 'N/A' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif

                        <!-- Attachments -->
                        @if(count($application->attachments) > 0)
                        <div class="col-span-1 md:col-span-3">
                            <h3 class="text-lg font-medium text-gray-900 mb-4 mt-6">Attachments</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($application->attachments as $attachment)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $attachment->type }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank" class="text-blue-600 hover:underline">
                                                    {{ basename($attachment->file_path) }}
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
