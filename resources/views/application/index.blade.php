@extends('layouts.index')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-md max-w-5xl mx-auto">
    <h2 class="text-2xl font-semibold text-center mb-6">Submitted Applications</h2>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">ID</th>
                <th class="border p-2">Country</th>
                <th class="border p-2">University</th>
                <th class="border p-2">Troupe Name</th>
                <th class="border p-2">Submitted At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applications as $application)
                <tr>
                    <td class="border p-2">{{ $application->id }}</td>
                    <td class="border p-2">{{ $application->country }}</td>
                    <td class="border p-2">{{ $application->university }}</td>
                    <td class="border p-2">{{ $application->troupe_name }}</td>
                    <td class="border p-2">{{ $application->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
