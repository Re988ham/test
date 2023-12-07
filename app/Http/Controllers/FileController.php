<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        $files = File::all();
        return view('files.index', compact('files'));
    }

    public function create()
    {
        return view('files.create');
    }

    public function store(Request $request)
    {
        // Validate the file input
        $request->validate([
            'file' => 'required|file|max:2048'
        ]);

        // Store the file in the local storage and get the path
        $file = $request->file('file')->getClientOriginalName();
        $path = $request->file('file')->storeAs('files', $file);

        // Get the current user
        $user = Auth::user();

        // Create a new file record in the database
        File::create([
            'url' => $path,
            'owner_id' => $user->id,
            'group_id' => 1,
            'status' => 'free',
        ]);

        // Redirect back to the previous page or show a success message
        return back();
    }

    public function checkin($id)
    {
        // Find the file by id
        $file = File::find($id);

        // Update the file status to "in use"
        $file->update(['status' => 'in use']);

        // Download file for edit it
        return response()->download($file->path, null, ['Content-Type' => $file->mime_type]);
        // Redirect to the page
        return redirect()->back();
    }

    public function checkout(Request $request, $id)
    {
        // Find the file by id
        $file = File::find($id);

        // Check if the file exists
        if (!$file) {
            return abort(404, 'File not found');
        }

        // Check if the user is the owner of the file
        if (Auth::id() != $file->owner_id) {
            return abort(403, 'You are not the owner of this file');
        }

        // Validate the uploaded file
        $request->validate([
            'file' => 'required|file'
        ]);

        // Store the uploaded file in the storage
        $path = $request->file('file')->store('files');

        // Update the file url and status
        $file->update([
            'url' => $path,
            'status' => 'free'
        ]);

        // Return a response with a success message
        return response()->json(['message' => 'File checked out successfully']);
    }


}
