<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {

        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {

        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    function signatureUpdate(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Not Authorized');
        }
        $request->validate([
            'signature' => 'mimes:jpeg,png,jpg,gif,svg|max:20048',
            'stamp' => 'mimes:jpeg,png,jpg,gif,svg|max:20048',
        ]);

        $user = Auth::user();

        // delete the old signature
        if ($request->hasFile('signature')) {
            $oldImage = public_path('images/signature/' . $user->signature);
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
        }

        // save the new signature
        if ($request->hasFile('signature')) {
            $image = $request->file('signature');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/signature'), $imageName);
            $user->signature = $imageName;
        }

        // delete the old stamp
        if ($request->hasFile('stamp')) {
            $oldImage = public_path('images/stamp/' . $user->stamp);
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
        }
        // save the new stamp
        if ($request->hasFile('stamp')) {
            $image = $request->file('stamp');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/stamp'), $imageName);
            $user->stamp = $imageName;
        }

        $user->save();


        return redirect()->back()->with('status', 'Signature updated successfully');
    }

    function signatureUpdateForm()
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Not Authorized');
        }
        return view('signature');
    }
}
