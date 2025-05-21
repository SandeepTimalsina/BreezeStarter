<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\Goal;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class GoalController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return[
            new Middleware('permission:view goals',only:['index']),
            new Middleware('permission:edit goals',only:['edit']),
            new Middleware('permission:create goals',only:['create']),
            new Middleware('permission:delete goals',only:['destroy']),
        ];
    }
    /**
     * Display a listing of the goals.
     */
    public function index()
    {
        $goals = Goal::all();
        return view('goals.index', compact('goals'));
    }

    /**
     * Show the form for creating a new goal.
     */
    public function create()
    {
        return view('goals.create');
    }

    /**
     * Store a newly created goal in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'deadline' => 'required|date',
            'extended_time'=>'required|date',
            'required_files' => 'nullable|array', // Allow multiple files or no files
            'required_files.*' => 'file|mimes:jpg,png,pdf,docx,txt', // Validate file types
        ]);

        // Prepare the data
        $data = $request->all();

        // Store the currently authenticated user ID as 'created_by'
        $data['author'] = Auth::id(); // Store only the user ID


        // Handle file uploads
        if ($request->hasFile('required_files')) {
            $files = $request->file('required_files');
            
            // Ensure the 'goals' directory exists inside the 'storage/app/public' folder
            $directory = 'goals';
            
            // Create the directory if it doesn't exist
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }

            // Check if only one file is uploaded or multiple files
            if (count($files) === 1) {
                // Store the single file's original name with a timestamp
                $file = $files[0];
                $fileName = Carbon::now()->format('Y-m-d_H-i-s') . '_' . $file->getClientOriginalName();
                
                // Store the file in 'storage/app/public/goals' directory with timestamp
                $file->storeAs($directory, $fileName, 'public');
                
                // Store the relative path in the database
                $data['required_files'] = '/storage/goals/' . $fileName;
            } else {
                // Store multiple files' original names with a timestamp as a JSON array
                $fileNames = [];
                foreach ($files as $file) {
                    $fileName = Carbon::now()->format('Y-m-d_H-i-s') . '_' . $file->getClientOriginalName();
                    // Store each file in 'storage/app/public/goals' directory with timestamp
                    $file->storeAs($directory, $fileName, 'public');
                    $fileNames[] = '/storage/goals/' . $fileName;
                }
                // Store the relative paths as a JSON array in the database
                $data['required_files'] = json_encode($fileNames);
            }
        }

        // Create the goal
        Goal::create($data);

        return redirect()->route('goals.index')->with('success', 'Goal created successfully.');
    }

    /**
     * Show the form for editing the specified goal.
     */
    public function edit(Goal $goal)
    {
        return view('goals.edit', compact('goal'));
    }

    /**
     * Update the specified goal in storage.
     */
    public function update(Request $request, Goal $goal)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'deadline' => 'required|date',
            'extended_time'=>'required|date',
            'required_files' => 'nullable|array', // Allow multiple files or no files
            'required_files.*' => 'file|mimes:jpg,png,pdf,docx,txt', // Validate file types
        ]);

        // Prepare the data
        $data = $request->all();

        // Handle file uploads
        if ($request->hasFile('required_files')) {
            if ($goal->required_files) {
                $files = json_decode($goal->required_files);
                if (is_array($files)) {
                    foreach ($files as $file) {
                        Storage::disk('public')->delete(str_replace('/storage/', '', $file));
                    }
                } else {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $goal->required_files));
                }
            }
            $files = $request->file('required_files');
            
            // Ensure the 'goals' directory exists inside the 'storage/app/public' folder
            $directory = 'goals';
            
            // Create the directory if it doesn't exist
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }

            // Check if only one file is uploaded or multiple files
            if (count($files) === 1) {
                // Store the single file's original name with a timestamp
                $file = $files[0];
                $fileName = Carbon::now()->format('Y-m-d_H-i-s') . '_' . $file->getClientOriginalName();
                
                // Store the file in 'storage/app/public/goals' directory with timestamp
                $file->storeAs($directory, $fileName, 'public');
                
                // Store the relative path in the database
                $data['required_files'] = '/storage/goals/' . $fileName;
            } else {
                // Store multiple files' original names with a timestamp as a JSON array
                $fileNames = [];
                foreach ($files as $file) {
                    $fileName = Carbon::now()->format('Y-m-d_H-i-s') . '_' . $file->getClientOriginalName();
                    // Store each file in 'storage/app/public/goals' directory with timestamp
                    $file->storeAs($directory, $fileName, 'public');
                    $fileNames[] = '/storage/goals/' . $fileName;
                }
                // Store the relative paths as a JSON array in the database
                $data['required_files'] = json_encode($fileNames);
            }
        }

        // Update the goal
        $goal->update($data);

        return redirect()->route('goals.index')->with('success', 'Goal updated successfully.');
    }

    /**
     * Remove the specified goal from storage.
     */
    public function destroy(Goal $goal)
    {
        // Delete the files if they exist
        if ($goal->required_files) {
            $files = json_decode($goal->required_files);
            if (is_array($files)) {
                foreach ($files as $file) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $file));
                }
            } else {
                Storage::disk('public')->delete(str_replace('/storage/', '', $goal->required_files));
            }
        }

        // Delete the goal
        $goal->delete();

        return redirect()->route('goals.index')->with('success', 'Goal deleted successfully.');
    }
}
