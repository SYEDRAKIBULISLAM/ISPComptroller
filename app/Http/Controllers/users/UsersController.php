<?php

namespace App\Http\Controllers\users;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $users = User::whereNotIn('id', [1])->paginate(15);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|max:255', 'username' => 'required|max:64|unique:users', 'email' => 'required|email|max:255', 'password' => 'required|min:6' ]);

        User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'contact' => $request['contact'],
            'password' => bcrypt($request['password']),
            'remember_token' => bcrypt($request['_token']),
        ]);

        Session::flash('flash_message', 'User added!');

        return redirect('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
       if($id != 1){
           $user = User::findOrFail($id);

           return view('users.edit', compact('user'));
       }
       else{
           Session::flash('warning_msg', 'Access deny');
           return redirect('users');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        if($id != 1) {
            $this->validate($request, ['name' => 'required|max:255', 'password' => 'required|min:6']);

            $user = User::findOrFail($id);

            $user->update([
                'name' => $request['name'],
                'contact' => $request['contact'],
                'password' => bcrypt($request['password']),
                'remember_token' => bcrypt($request['_token']),
            ]);

            Session::flash('flash_message', 'User updated!');

            return redirect('users');
        }
        else
        {
            Session::flash('warning_msg', 'Access deny');
            return redirect('users');
        }
    }

    /**
     * Block the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
//        if (Auth::user()->id != $id){
//            $user = User::findOrFail($id);
//
//            $user->delete();
//            Session::flash('flash_message', 'User deleted!');
//        }
        return redirect('users');
    }
}
