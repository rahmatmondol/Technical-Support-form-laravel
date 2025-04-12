<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Not Authorized');
        }

        return view('services.services', [
            'services' => Service::orderBy('id', 'desc')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Not Authorized');
        }
        return view('services.create_service_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Not Authorized');
        }
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
        ]);

        try {
            $service = new Service();
            $service->name = $validated['name'];
            $service->user_id = Auth::id();
            $service->save();

            return redirect()->route('services.index')->with('success', 'Service created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create service: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Not Authorized');
        }
        return view('services.edit_service_form', [
            'service' => $service,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Not Authorized');
        }
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
        ]);
        try {
            $service->name = $validated['name'];
            $service->save();
            return redirect()->route('services.index')->with('success', 'Service updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update service: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Not Authorized');
        }
        try {
            $service = Service::findOrFail($id);
            $service->delete();
            return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete service: ' . $e->getMessage());
        }
    }
}
