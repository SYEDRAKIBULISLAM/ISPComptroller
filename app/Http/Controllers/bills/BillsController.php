<?php

namespace App\Http\Controllers\bills;

use App\Consumer;
use App\Generate_bill;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Bill;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Input;

class BillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
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
        if (Input::has('fromdate') && Input::has('todate')){
            $bills = Bill::
            whereHas('consumer', function ($consumers) {
                $consumers->where('name', 'like', '%' .Input::get('consumer'). '%');
            })
                ->whereDate('created_at', '>=', Input::get('fromdate'))
                ->whereDate('created_at', '<=', Input::get('todate'))
                ->orderBy('id', 'desc')
                ->paginate(Input::get('rows'));
        }
        elseif (Input::has('rows')){
            $bills = Bill::
                whereHas('consumer', function ($consumers) {
                $consumers->where('name', 'like', '%' .Input::get('consumer'). '%');
                })
                ->orderBy('id', 'desc')
                ->paginate(Input::get('rows'));
        }
        else {
            $bills = Bill::orderBy('id', 'desc')->paginate(100);
        }


        return view('bills.index', compact('bills', 'sl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $consumers = Consumer::all();
        $bill_generators = Generate_bill::all();

        return view('bills.create', compact('consumers', 'bill_generators'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, ['consumer_id' => 'required', 'generate_bill_id' => 'required', 'user_id' => 'required', 'amount' => 'required', ]);

        Bill::create($request->all());

        Session::flash('flash_message', 'Bill added!');

        return redirect('bills');
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
        $bill = Bill::findOrFail($id);

        return view('bills.show', compact('bill'));
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
        $bill = Bill::findOrFail($id);

        return view('bills.edit', compact('bill'));
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
        $this->validate($request, ['consumer_id' => 'required', 'generate_bill_id' => 'required', 'user_id' => 'required', 'amount' => 'required', ]);

        $bill = Bill::findOrFail($id);
        $bill->update($request->all());

        Session::flash('flash_message', 'Bill updated!');

        return redirect('bills');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        $bill = Bill::findOrFail($id);

        $bill->delete();

        Session::flash('flash_message', 'Bill deleted!');

        return redirect('bills');
    }
}
