@extends('layouts.index')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-md max-w-3xl mx-auto">
    <h2 class="text-2xl font-semibold text-center mb-6">FITUC Festival Application</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('application.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <!-- Country -->
        <div>
            <label class="block font-medium">Country:</label>
            <input type="text" name="country" required class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
        </div>

        <!-- University -->
        <div>
            <label class="block font-medium">University:</label>
            <input type="text" name="university" required class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
        </div>

        <!-- Troupe Name -->
        <div>
            <label class="block font-medium">Troupe Name:</label>
            <input type="text" name="troupe_name" required class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
        </div>

        <!-- Play Title -->
        <div>
            <label class="block font-medium">Play Title:</label>
            <input type="text" name="play_title" class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
        </div>

        <!-- Play Duration -->
        <div>
            <label class="block font-medium">Duration (max 60 min):</label>
            <input type="number" name="duration" class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
        </div>

        <!-- Play Summary -->
        <div>
            <label class="block font-medium">Play Summary:</label>
            <textarea name="summary" class="w-full border rounded p-2 focus:ring focus:ring-blue-300"></textarea>
        </div>

        <!-- Attachment -->
        <div>
            <label class="block font-medium">Upload Poster/Files:</label>
            <input type="file" name="attachment" class="w-full border rounded p-2">
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Submit Application
            </button>
        </div>
    </form>
</div>
@endsection
