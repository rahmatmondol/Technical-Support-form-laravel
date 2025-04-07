<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Service;
use Illuminate\Http\Request;

class FormController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all forms
        if (auth()->user()->hasRole('editor')) {
            $forms = Form::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(20);
        } elseif (auth()->user()->hasRole('admin')) {
            $editor_id = request()->query('editor');
            if ($editor_id) {
                $forms = Form::where('user_id', $editor_id)->orderBy('id', 'desc')->paginate(20);
            } else {
                $forms = Form::orderBy('id', 'desc')->paginate(20);
            }
        }

        // return $forms;

        return view('form.forms', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //create a 10 digit invoice number unique with invoice_id column in Form model
        do {
            // Generate a random 10-digit number
            $invoiceNumber = mt_rand(1000000000, 9999999999);

            // Check if this number already exists in the database
            $exists = Form::where('invoice_id', $invoiceNumber)->exists();
        } while ($exists);

        //get service list
        $services = Service::get()->pluck('name')->toArray();
        // dd($services);

        return view('form.form', ['invoice_id' => $invoiceNumber, 'services' => $services]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->toArray());

        // $validated = $request->validate([
        //     'invoice_id' => 'numeric|unique:forms,invoice_id',
        //     'service_submission_date' => 'date',
        //     'customer_name' => 'string|max:255|nullable',
        //     'address_line_1' => 'nullable|string|min:3|max:255|nullable',
        //     'address_city' => 'string|max:255|nullable',
        //     'address_country' => 'string|max:255|nullable',
        //     'electronic_account_name' => 'string|max:255|nullable',
        //     'type' => 'string|max:255|nullable',
        //     'agreed_to_terms' => 'string|in:yes,"I agreed through WhatsApp"',
        //     'phone_number' => 'string|max:25|nullable',
        //     'amount_previously_paid' => 'numeric|nullable',
        //     'electronic_signature' => 'string|nullable',
        //     'comments' => 'nullable|string|max:100',
        // ]);

        try {
            //create a new form
            $form = new Form;
            $form->invoice_id = $request->invoice_id ??  mt_rand(1000000000, 9999999999);
            $form->service_submission_date = $request->service_submission_date ?? now();
            $form->customer_name = $request->customer_name ?? 'N/A';
            $form->address_line_1 = $request->address_line_1 ?? 'N/A';
            $form->address_city = $request->address_city ?? 'N/A';
            $form->address_country = $request->address_country ?? 'N/A';
            $form->electronic_account_name = $request->electronic_account_name ?? 'N/A';
            $form->type = $request->type ?? 'N/A';
            $form->agreed_to_terms = $request->agreed_to_terms ?? 'N/A';
            $form->phone_number = $request->phone_number ?? 'N/A';
            $form->amount_previously_paid = $request->amount_previously_paid ?? 0;
            $form->electronic_signature = $request->electronic_signature ?? 'N/A';
            $form->comments = $request->comments ?? 'N/A';
            $form->save();

            if (auth()->check()) {
                $form->user_id = auth()->user()->id;
                $form->save();
                return redirect()->route(route: 'dashboard')->with('success', 'Form submitted successfully');
            }

            return redirect()->route(route: 'form.create')->with('success', 'Form submitted successfully');
        } catch (\Exception $e) {
            return redirect()->route('form.create')->with('error', 'Form submission failed: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {

        // dd($form->toArray());

        // //
        return view('form.print', ['forms' => [$form]]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Form $form)
    {
        //
        $services = Service::get()->pluck('name')->toArray();
        return view('form.edit', compact('form', 'services'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    public function update(Request $request, Form $form)
    {
        $validated = $request->validate([
            'service_submission_date' => 'required|date',
            'customer_name' => 'required|string|max:255',
            'address_city' => 'required|string|max:255',
            'address_country' => 'required|string|max:255',
            'electronic_account_name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'agreed_to_terms' => 'required|string|in:yes,"I agreed through WhatsApp"',
            'phone_number' => 'required|string|max:25',
            'amount_previously_paid' => 'required|numeric',
            'electronic_signature' => 'required|string',
            'comments' => 'nullable|string|max:300',
        ]);

        try {
            $form->update($validated);
            return redirect()->route('form.edit', $form->id)->with('success', 'Form updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('form.edit', $form->id)->with('error', 'Failed to update form: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $form = Form::findOrFail($id);
            $form->delete();
            return redirect()->back()->with('success', 'Form deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete form: ' . $e->getMessage());
        }
    }

    public function printSelected(Request $request)
    {
        $selectedForms = $request->selected_forms;

        // Fetch all services with the given IDs
        $form = Form::whereIn('id', $selectedForms)->get();

        return view('form.print', [
            'forms' => $form,
        ]);
    }

    public function list()
    {
        // Fetch all services with the given IDs
        $form = Form::orderBy('id', 'desc')->paginate(100);
        return response()->json($form);
    }
}
