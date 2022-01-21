<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->user()->cannot('browse-users')) {
            return redirect()->route('dashboard')->with('warning', __('Action not Authorized.'));
        }

        return view('users.index', ['users' => User::query()->whereNotIn('id',[1])->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (request()->user()->cannot('create-users')) {
            return redirect()->route('dashboard')->with('warning', __('Action not Authorized.'));
        }

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create-users')) {
            return redirect()->route('dashboard')->with('warning', __('Action not Authorized.'));
        }

        $request->validate(
            [
                'name' => ['required', 'string', 'min:8', 'max:25'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'max:25', 'confirmed'],
                'password_confirmation' => ['required', 'string', 'min:8', 'max:25'],
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => $request->type,
            'password' => Hash::make($request->password)
        ]);

        session()->flash('success', __('User created.'));

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if ($user->id === 1) {
            session()->flash('warning', __('Action not Authorized.'));
            return redirect()->route('users.index');
        }

        if (request()->user()->cannot('update-users')) {
            return redirect()->route('dashboard')->with('warning', __('Action not Authorized.'));
        }

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($user->id === 1) {
            session()->flash('warning', __('Action not Authorized.'));
            return redirect()->route('users.index');
        }

        $request->validate(
            [
                'name' => ['required', 'string', 'min:8', 'max:25'],
                'email' => ['required', 'email', 'unique:users,id,' . $user->id],
            ]
        );
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'active' => $request->active,
            'is_admin' => $request->type,
        ]);

        if ($request->password != null) {
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'max:25', 'confirmed'],
                'password_confirmation' => ['required', 'string', 'min:8', 'max:25'],
            ]);
            $user->password = Hash::make($request->password);
            $user->save();
        }

        session()->flash('success', __('User updated.'));

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
