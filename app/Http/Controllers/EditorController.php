<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\User;
use Illuminate\Http\Request;

class EditorController extends Controller
{
    public function index()
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Not Authorized');
        }
        $editors = User::role('editor')->with('forms')->get();
        // calclulate total amount 
        $editors->each(function ($editor) {
            $editor->total_amount = $editor->forms->sum('amount_previously_paid');
        });

        // return $editors;
        return view('editor.index', compact('editors'));
    }

    public function create()
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Not Authorized');
        }
        // Return the view for creating a new editor
        return view('auth.register');
    }


    public function store(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Not Authorized');
        }

        // Validate and store the editor data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Store the editor in the database
        $user = User::create($validatedData);

        // assign the editor role
        $user->assignRole('editor');

        return redirect()->route('editor')->with('success', 'Editor created successfully.');
    }
    public function edit($id)
    {
        // Find the editor by ID and return the edit view
        // $editor = User::findOrFail($id);
        // return view('editor.edit', compact('editor'));
    }
    public function update(Request $request, $id)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Not Authorized');
        }
        // Validate and update the editor data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update the editor in the database
        // User::where('id', $id)->update($validatedData);

        return redirect()->route('editor.index')->with('success', 'Editor updated successfully.');
    }
    public function destroy($id)
    {
        // Delete the editor from the database
        // User::destroy($id);

        return redirect()->route('editor.index')->with('success', 'Editor deleted successfully.');
    }
    public function show($id)
    {
        // Find the editor by ID and return the show view
        // $editor = User::findOrFail($id);
        // return view('editor.show', compact('editor'));
    }
    public function printSelected(Request $request)
    {
        // Handle the print selected functionality
        // $selectedForms = $request->input('selected_forms');
        // return view('editor.print', compact('selectedForms'));
    }
    public function download(Request $request)
    {
        // Handle the download functionality
        // $selectedForms = $request->input('selected_forms');
        // return response()->download(storage_path('app/public/forms/' . $selectedForms));
    }
    public function search(Request $request)
    {
        // Handle the search functionality
        // $query = $request->input('query');
        // $results = User::where('name', 'LIKE', "%$query%")->get();
        // return view('editor.search', compact('results'));
    }
}
