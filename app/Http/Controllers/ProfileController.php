<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function __construct()
    {
        $this->middleware('can:profile.index');
    }
     
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
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function UpdateAvatar(Request $request){
        $request->validate([
            'avatar' => ['required', 'mimes:jpeg,jpg,png'],
        ]);
        $filename = time().".".$request->avatar->extension();
        $request->avatar->move(public_path("img_profile"),$filename);

        $imagen_anterior = Auth::user()->avatar;
        if($imagen_anterior != null){
            unlink(public_path('img_profile/'.$imagen_anterior));
        }
        User::where('id',Auth::user()->id)->update(['avatar'=>$filename]);

        return redirect('/profile')->with('update_avatar', 'Avatar actualizado con exito!!');   
    }
}
