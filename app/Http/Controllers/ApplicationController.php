<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Attachment;
use App\Models\CompanyInfo;
use App\Models\Contact;
use App\Models\PlayDetail;
use App\Models\TechnicalDetail;
use App\Models\CastMember;
use App\Models\ParticipationHistory;
use App\Models\PreviousPerformance;
use App\Models\UpcomingPerformance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    // Display the application form
    public function create()
    {
        return view('application.create');
    }

    // Display list of all applications (admin only)
    public function index()
    {
        $applications = Application::with(['user', 'contact', 'playDetail'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.applications.index', compact('applications'));
    }
    
    // Display a specific application (admin only)
    public function show($id)
    {
        $application = Application::with([
            'user', 
            'contact', 
            'playDetail', 
            'companyInfo', 
            'technicalDetail', 
            'castMembers', 
            'participationHistories', 
            'upcomingPerformances',
            'attachments'
        ])->findOrFail($id);
        
        return view('admin.applications.show', compact('application'));
    }
    
    // Update application status (admin only)
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:submitted,under_review,approved,rejected',
            'feedback' => 'nullable|string|max:1000',
        ]);
        
        $application = Application::findOrFail($id);
        $application->status = $validated['status'];
        
        // Store feedback if provided
        if (isset($validated['feedback'])) {
            // We'll add a feedback field to the applications table in a separate migration
            $application->feedback = $validated['feedback'];
        }
        
        $application->save();
        
        // Notify the user about the status change (could be implemented later)
        // Notification::send($application->user, new ApplicationStatusChanged($application));
        
        return redirect()->route('application.show', $id)
            ->with('success', 'Application status updated successfully');
    }
    
    // Delete an application (admin only)
    public function destroy($id)
    {
        $application = Application::findOrFail($id);
        $application->delete();
        
        return redirect()->route('application.index')
            ->with('success', 'Application deleted successfully');
    }

    // Store the application in the database
    public function store(Request $request)
    {
        // Enable query logging for debugging
        DB::enableQueryLog();
        
        // Debug mode - dump all request data if debug_mode is set
        if ($request->has('debug_mode')) {
            Log::info('DEBUG MODE ENABLED - Application submission request received', [
                'user_id' => Auth::id(),
                'is_authenticated' => Auth::check(),
                'all_request_data' => $request->all(),
                'request_method' => $request->method(),
                'request_path' => $request->path(),
                'request_url' => $request->url(),
                'request_ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }
        
        // Log the incoming request data for debugging
        Log::info('Application submission request received', [
            'user_id' => Auth::id(),
            'request_data' => $request->except(['attachments']),
            'has_files' => $request->hasFile('attachments'),
            'is_ajax' => $request->ajax() || $request->has('ajax_submission')
        ]);
        
        // Validate Basic Information
        $validatedData = $request->validate([
            'country'      => 'required|string|max:255',
            'university'   => 'required|string|max:255',
            'troupe_name'  => 'required|string|max:255',
            'play_title'   => 'required|string|max:255',
            'author'       => 'required|string|max:255',
            'director'     => 'required|string|max:255',
            'duration'     => 'required|integer|max:60',
            'summary'      => 'required|string|max:2000',
            
            // Play Details
            'language'     => 'nullable|string|max:255',
            'premiere_date' => 'nullable|date',
            'english_summary' => 'nullable|string|max:2000',
            'french_summary' => 'nullable|string|max:2000',
            'arabic_summary' => 'nullable|string|max:2000',
            'play_link'    => 'nullable|url|max:255',
            
            // Company Info
            'founded_year' => 'nullable|integer|min:1900|max:2025',
            'company_background' => 'nullable|string|max:2000',
            'repertoireStyle' => 'nullable|string|max:255',
            'alreadyPlayed' => 'nullable|string|max:10',
            'actors_count' => 'nullable|integer|min:0',
            
            // Contact Information
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|email:rfc,dns|max:255',
            'contact_phone' => ['required', 'string', 'max:20', 'regex:/^[+]?[0-9]{10,15}$/'],
            'contact_position' => 'nullable|string|max:255',
            
            // Technical Details
            'staging_type' => 'nullable|string|max:255',
            'special_requirements' => 'nullable|string|max:1000',
            'technical_notes' => 'nullable|string|max:1000',
            
            // Cast Members (dynamic)
            'cast_names.*' => 'nullable|string|max:255',
            'cast_roles.*' => 'nullable|string|max:255',
            
            // Participation History (dynamic)
            'previous_festival.*' => 'nullable|string|max:255',
            'previous_year.*' => 'nullable|integer',
            'previous_play.*' => 'nullable|string|max:255',
            
            // Previous Performances (dynamic)
            'previousPerformances.*.number' => 'nullable|integer',
            'previousPerformances.*.place' => 'nullable|string|max:255',
            'previousPerformances.*.date' => 'nullable|date',
            
            // Upcoming Performances (dynamic)
            'upcomingPerformances.*.date' => 'nullable|date',
            'upcomingPerformances.*.place' => 'nullable|string|max:255',
            
            // Attachments
            'attachments.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
            'attachment_types.*' => 'nullable|string|max:255',
        ]);
        
        try {
            // Check if user is authenticated
            if (!Auth::check()) {
                Log::warning('Unauthenticated user attempted to submit application');
                if ($request->ajax() || $request->has('ajax_submission')) {
                    return response()->json([
                        'success' => false,
                        'message' => 'You must be logged in to submit an application.',
                        'redirect' => route('login')
                    ]);
                }
                return redirect()->route('login')->with('error', 'You must be logged in to submit an application.');
            }

            // Create Application with transaction to ensure all related data is saved or none
            $application = DB::transaction(function() use ($request) {
                // Log transaction start
                Log::info('Starting application transaction');
                
                // Create the main application record
                $application = Application::create([
                    'country' => $request->country,
                    'university' => $request->university,
                    'troupe_name' => $request->troupe_name,
                    'play_title' => $request->play_title,
                    'author' => $request->author,
                    'director' => $request->director,
                    'duration' => $request->duration,
                    'summary' => $request->summary,
                    'submission_date' => now(),
                    'user_id' => Auth::id(),
                    'status' => 'submitted', // Set initial status
                ]);
                
                // Save Play Details
                if ($request->has('language') || $request->has('premiere_date') || 
                    $request->has('english_summary') || $request->has('french_summary') ||
                    $request->has('arabic_summary') || $request->has('play_link')) {
                    
                    PlayDetail::create([
                        'application_id' => $application->id,
                        'language' => $request->language,
                        'premiere_date' => $request->premiere_date,
                        'english_summary' => $request->english_summary,
                        'french_summary' => $request->french_summary,
                        'arabic_summary' => $request->arabic_summary,
                        'play_link' => $request->play_link,
                    ]);
                }
                
                // Save Company Info
                if ($request->has('founded_year') || $request->has('company_background') || 
                    $request->has('repertoireStyle') || $request->has('alreadyPlayed') ||
                    $request->has('actors_count')) {
                    
                    CompanyInfo::create([
                        'application_id' => $application->id,
                        'founded_year' => $request->founded_year,
                        'background' => $request->company_background,
                        'repertoire_style' => $request->repertoireStyle,
                        'already_played' => $request->alreadyPlayed,
                        'actors_count' => $request->actors_count,
                    ]);
                }
                
                // Save Contact Information
                if ($request->has('contact_name')) {
                    Contact::create([
                        'application_id' => $application->id,
                        'name' => $request->contact_name,
                        'email' => $request->contact_email,
                        'phone' => $request->contact_phone,
                        'position' => $request->contact_position,
                    ]);
                }
                
                // Save Technical Details
                if ($request->has('staging_type') || $request->has('special_requirements') || 
                    $request->has('technical_notes')) {
                        
                    TechnicalDetail::create([
                        'application_id' => $application->id,
                        'staging_type' => $request->staging_type,
                        'special_requirements' => $request->special_requirements,
                        'technical_notes' => $request->technical_notes,
                    ]);
                }
                
                // Save Cast Members
                if ($request->has('cast_names')) {
                    foreach ($request->cast_names as $index => $name) {
                        if (!empty($name)) {
                            CastMember::create([
                                'application_id' => $application->id,
                                'name' => $name,
                                'role' => $request->cast_roles[$index] ?? null,
                            ]);
                        }
                    }
                }
                
                // Save Participation History
                if ($request->has('previous_festival')) {
                    foreach ($request->previous_festival as $index => $festival) {
                        if (!empty($festival)) {
                            ParticipationHistory::create([
                                'application_id' => $application->id,
                                'festival_name' => $festival,
                                'year' => $request->previous_year[$index] ?? null,
                                'play_title' => $request->previous_play[$index] ?? null,
                            ]);
                        }
                    }
                }
                
                // Save Previous Performances
                if ($request->has('previousPerformances')) {
                    foreach ($request->previousPerformances as $performance) {
                        if (!empty($performance['place'] ?? '') || !empty($performance['date'] ?? '')) {
                            PreviousPerformance::create([
                                'application_id' => $application->id,
                                'performance_number' => $performance['number'] ?? null,
                                'place' => $performance['place'] ?? null,
                                'performance_date' => $performance['date'] ?? null,
                            ]);
                        }
                    }
                }
                
                // Save Upcoming Performances
                if ($request->has('upcomingPerformances')) {
                    foreach ($request->upcomingPerformances as $performance) {
                        if (!empty($performance['place'] ?? '') || !empty($performance['date'] ?? '')) {
                            UpcomingPerformance::create([
                                'application_id' => $application->id,
                                'place' => $performance['place'] ?? null,
                                'performance_date' => $performance['date'] ?? null,
                            ]);
                        }
                    }
                }
                
                // Handle File Uploads
                if ($request->hasFile('attachments')) {
                    foreach ($request->file('attachments') as $index => $file) {
                        $type = $request->attachment_types[$index] ?? 'document';
                        $originalFilename = $file->getClientOriginalName();
                        $filePath = $file->store('attachments/' . $application->id, 'public');
                        
                        Attachment::create([
                            'application_id' => $application->id,
                            'file_type' => $type,
                            'file_path' => $filePath,
                            'original_filename' => $originalFilename,
                        ]);
                    }
                }
                
                return $application;
            });

            // Log the successful submission
            Log::info('Application submitted successfully', [
                'application_id' => $application->id,
                'user_id' => Auth::id(),
                'queries' => DB::getQueryLog()
            ]);

            // Return JSON response for AJAX requests
            if ($request->ajax() || $request->has('ajax_submission')) {
                return response()->json([
                    'success' => true,
                    'message' => 'Application submitted successfully!',
                    'redirect' => route('dashboard'),
                    'application_id' => $application->id
                ]);
            }

            return redirect()->route('dashboard')->with('success', 'Application submitted successfully!');
        } catch (\Exception $e) {
            // Log detailed error information
            Log::error('Application submission error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['attachments']),
                'queries' => DB::getQueryLog(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            
            if ($request->ajax() || $request->has('ajax_submission')) {
                return response()->json([
                    'success' => false,
                    'message' => 'There was an error submitting your application. Please try again.',
                    'error' => $e->getMessage(),
                    'debug_info' => [
                        'line' => $e->getLine(),
                        'file' => $e->getFile()
                    ]
                ], 500);
            }
            
            return redirect()->back()->with('error', 'There was an error submitting your application. Please try again.');
        }
    }
}
