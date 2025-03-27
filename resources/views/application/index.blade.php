@extends('layouts.index')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-md max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Festival Applications</h2>
        <div class="flex space-x-2">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                Dashboard
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($applications->isEmpty())
        <div class="text-center py-8">
            <p class="text-gray-500">No applications have been submitted yet.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <th class="px-4 py-3 border-b-2 border-gray-200">ID</th>
                        <th class="px-4 py-3 border-b-2 border-gray-200">Country</th>
                        <th class="px-4 py-3 border-b-2 border-gray-200">University</th>
                        <th class="px-4 py-3 border-b-2 border-gray-200">Troupe</th>
                        <th class="px-4 py-3 border-b-2 border-gray-200">Play Title</th>
                        <th class="px-4 py-3 border-b-2 border-gray-200">Status</th>
                        <th class="px-4 py-3 border-b-2 border-gray-200">Submitted</th>
                        <th class="px-4 py-3 border-b-2 border-gray-200">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($applications as $application)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 border-b border-gray-200">{{ $application->id }}</td>
                            <td class="px-4 py-3 border-b border-gray-200">{{ $application->country }}</td>
                            <td class="px-4 py-3 border-b border-gray-200">{{ $application->university }}</td>
                            <td class="px-4 py-3 border-b border-gray-200">{{ $application->troupe_name }}</td>
                            <td class="px-4 py-3 border-b border-gray-200">{{ $application->play_title }}</td>
                            <td class="px-4 py-3 border-b border-gray-200">
                                <span class="px-2 py-1 font-semibold text-xs rounded-full
                                    @if($application->status === 'submitted') bg-blue-100 text-blue-800
                                    @elseif($application->status === 'under_review') bg-yellow-100 text-yellow-800
                                    @elseif($application->status === 'approved') bg-green-100 text-green-800
                                    @elseif($application->status === 'rejected') bg-red-100 text-red-800
                                    @endif
                                ">
                                    {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 border-b border-gray-200">{{ $application->created_at->format('Y-m-d') }}</td>
                            <td class="px-4 py-3 border-b border-gray-200">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('application.show', $application->id) }}" 
                                       class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-xs">
                                        View
                                    </a>
                                    <form action="{{ route('application.status.update', $application->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" 
                                                class="text-xs border rounded px-1 py-1">
                                            <option value="submitted" {{ $application->status === 'submitted' ? 'selected' : '' }}>Submitted</option>
                                            <option value="under_review" {{ $application->status === 'under_review' ? 'selected' : '' }}>Under Review</option>
                                            <option value="approved" {{ $application->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </form>
                                    <form action="{{ route('application.destroy', $application->id) }}" method="POST" 
                                          onsubmit="return confirm('Are you sure you want to delete this application?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
