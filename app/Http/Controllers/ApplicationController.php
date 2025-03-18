<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    // Display the application form
    public function create()
    {
        return view('application.create');
    }

    // Store the application in the database
    public function store(Request $request)
    {
        // 4️⃣ Validate Input Data
        $validatedData = $request->validate([
            'country'      => 'required|string|max:255',
            'university'   => 'required|string|max:255',
            'troupe_name'  => 'required|string|max:255',
            'play_title'   => 'nullable|string|max:255',
            'duration'     => 'nullable|integer|max:60',
            'summary'      => 'nullable|string|max:1000',
            'attachment'   => 'nullable|file|mimes:pdf,jpg,png|max:2048'
        ]);

        // 5️⃣ Store Application Data
        $application = Application::create($validatedData);

        // 6️⃣ Handle File Upload (if exists)
        if ($request->hasFile('attachment')) {
            $filePath = $request->file('attachment')->store('attachments', 'public');
            $application->attachments()->create([
                'file_type' => $request->file('attachment')->getClientOriginalExtension(),
                'file_path' => $filePath,
                'original_filename' => $request->file('attachment')->getClientOriginalName(),
            ]);
        }

        return redirect()->route('application.create')->with('success', 'Application submitted successfully!');
    }

    // 7️⃣ Show all applications in the admin panel
    public function index()
    {
        $applications = Application::with('attachments')->get();
        return view('application.index', compact('applications'));
    }
}
