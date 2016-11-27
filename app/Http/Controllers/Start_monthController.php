<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Start_month;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class Start_monthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $start_month = Start_month::paginate(15);

        return view('start_month.index', compact('start_month'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
//    public function create()
//    {
//        return view('start_month.create');
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
//    public function store(Request $request)
//    {
//        $this->validate($request, ['day' => 'required', ]);
//
//        Start_month::create($request->all());
//
//        Session::flash('flash_message', 'Start_month added!');
//
//        return redirect('start_month');
//    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
//    public function show($id)
//    {
//        $start_month = Start_month::findOrFail($id);
//
//        return view('start_month.show', compact('start_month'));
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        $start_month = Start_month::findOrFail($id);

        return view('start_month.edit', compact('start_month'));
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
        $this->validate($request, ['day' => 'required', ]);

        $start_month = Start_month::findOrFail($id);
        $start_month->update($request->all());

        Session::flash('flash_message', 'Start month updated!');

        return redirect('start_month');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
//    public function destroy($id)
//    {
//        Start_month::destroy($id);
//
//        Session::flash('flash_message', 'Start_month deleted!');
//
//        return redirect('start_month');
//    }
}
