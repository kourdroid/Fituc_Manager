<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Quick Actions Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Quick Actions</h3>
                        <div class="space-y-3">
                            <a href="{{ route('application.create') }}" class="inline-block w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-center">
                                Submit New Application
                            </a>
                            
                            @can('manage-applications')
                            <a href="{{ route('application.index') }}" class="inline-block w-full px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 text-center">
                                View All Applications
                            </a>
                            @endcan
                            
                            <a href="{{ route('profile.edit') }}" class="inline-block w-full px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-300 dark:hover:bg-gray-600 text-center">
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Festival Info Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Festival Information</h3>
                        <div class="space-y-3 text-gray-700 dark:text-gray-300">
                            <p><span class="font-medium">Theme:</span> Theater and Artistic-Cultural Diplomacy</p>
                            <p><span class="font-medium">Dates:</span> July 10-15, 2025</p>
                            <p><span class="font-medium">Location:</span> Casablanca, Morocco</p>
                            <p><span class="font-medium">Edition:</span> 37th</p>
                            <p class="text-sm mt-4">For more information, please contact <a href="mailto:info@fituc.com" class="text-blue-600 dark:text-blue-400 hover:underline">info@fituc.com</a></p>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Deadlines Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Important Dates</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-700 dark:text-gray-300">Application Deadline</span>
                                <span class="font-medium text-gray-900 dark:text-gray-100">May 15, 2025</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 65%"></div>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">65 days remaining</p>
                            
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-3 mt-3">
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-700 dark:text-gray-300">Selection Results</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100">June 01, 2025</span>
                                </div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-700 dark:text-gray-300">Festival Start</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100">July 10, 2025</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-700 dark:text-gray-300">Festival End</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100">July 15, 2025</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- My Applications -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">My Applications</h3>
                    
                    @php
                        $userApplications = Auth::user()->applications ?? collect();
                    @endphp
                    
                    @if($userApplications->isEmpty())
                        <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                            <p>You haven't submitted any applications yet.</p>
                            <a href="{{ route('application.create') }}" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Submit Your First Application
                            </a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-3 text-left">Play Title</th>
                                        <th class="px-4 py-3 text-left">Troupe</th>
                                        <th class="px-4 py-3 text-left">Submitted</th>
                                        <th class="px-4 py-3 text-left">Status</th>
                                        <th class="px-4 py-3 text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($userApplications as $application)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-750">
                                            <td class="px-4 py-3">{{ $application->play_title }}</td>
                                            <td class="px-4 py-3">{{ $application->troupe_name }}</td>
                                            <td class="px-4 py-3">{{ $application->created_at->format('Y-m-d') }}</td>
                                            <td class="px-4 py-3">
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full
                                                    @if($application->status === 'submitted') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                                    @elseif($application->status === 'under_review') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                                    @elseif($application->status === 'approved') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                    @elseif($application->status === 'rejected') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                                    @endif
                                                ">
                                                    {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3">
                                                @if($application->status === 'submitted')
                                                    <a href="{{ route('application.create') }}?edit={{ $application->id }}" class="text-blue-600 dark:text-blue-400 hover:underline">Edit</a>
                                                @else
                                                    <span class="text-gray-400 dark:text-gray-600">Edit</span>
                                                @endif
                                                
                                                @if($application->feedback)
                                                    <button 
                                                        type="button" 
                                                        class="ml-3 text-indigo-600 dark:text-indigo-400 hover:underline"
                                                        onclick="showFeedback('{{ $application->id }}')">
                                                        View Feedback
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Feedback Modal -->
    <div id="feedbackModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Admin Feedback</h3>
                <div class="mt-2 px-7 py-3 bg-gray-100 dark:bg-gray-700 rounded-lg">
                    <p id="feedbackContent" class="text-gray-700 dark:text-gray-300 whitespace-pre-line"></p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="closeModal" class="px-4 py-2 bg-blue-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script>
        // Feedback modal functionality
        const feedbackData = {
            @foreach($userApplications as $application)
                @if($application->feedback)
                    '{{ $application->id }}': `{{ $application->feedback }}`,
                @endif
            @endforeach
        };
        
        function showFeedback(applicationId) {
            const modal = document.getElementById('feedbackModal');
            const content = document.getElementById('feedbackContent');
            
            content.textContent = feedbackData[applicationId] || 'No feedback available';
            modal.classList.remove('hidden');
        }
        
        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('feedbackModal').classList.add('hidden');
        });
    </script>
    @endpush
</x-app-layout>
