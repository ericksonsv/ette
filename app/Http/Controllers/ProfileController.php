<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show');
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'min:8', 'max:25'],
                'email' => ['required', 'email', 'unique:users,id,' . auth()->user()->id],
            ]
        );

        $user = User::find(auth()->user()->id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password != null) {
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'max:25', 'confirmed'],
                'password_confirmation' => ['required', 'string', 'min:8', 'max:25'],
            ]);
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route('profile.show')->with('success', __('Profile updated.'));
    }
}
