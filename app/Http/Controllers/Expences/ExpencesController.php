<?php

namespace App\Http\Controllers\Expences;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Expence;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;

class ExpencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $sl = 0;
        if(Input::has('page')){
            if(Input::has('rows')) {
                $sl += (Input::get('page') - 1) * Input::get('rows');
            }
            else {
                $sl += (Input::get('page') - 1) * 100;
            }
        }
        $expences = Expence::paginate(25);

        return view('expences.index', compact('expences', 'sl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $today = Carbon::now();
        return view('expences.create', compact('today'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, ['user_id' => 'required', 'purpose' => 'required', 'amount' => 'required', 'date' => 'required' ]);
        
        Expence::create($request->all());

        Session::flash('flash_message', 'Expence added!');

        return redirect('expences');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $expence = Expence::findOrFail($id);

        return view('expences.show', compact('expence'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $expence = Expence::findOrFail($id);

        return view('expences.edit', compact('expence'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $expence = Expence::findOrFail($id);
        $expence->update($requestData);

        Session::flash('flash_message', 'Expence updated!');

        return redirect('expences');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $expence = Expence::findOrFail($id);

        $expence->delete();

        Session::flash('flash_message', 'Expence deleted!');

        return redirect('expences');
    }
}
