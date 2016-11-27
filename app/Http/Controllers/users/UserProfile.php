<?php

namespace App\Http\Controllers\users;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Session;

class UserProfile extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);

        return view('userprofile.index', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit()
    {
        $user = User::findOrFail(Auth::user()->id);

        return view('userprofile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function update(Request $request)
    {
        $this->validate($request, ['name' => 'required|max:255', 'password' => 'required|min:6' ]);

        $user = User::findOrFail(Auth::user()->id);

        $user->update([
            'name' => $request['name'],
            'password' => bcrypt($request['password']),
            'remember_token' => bcrypt($request['_token']),
        ]);

        Session::flash('flash_message', 'User updated!');

        return redirect('myprofile');
    }
}
