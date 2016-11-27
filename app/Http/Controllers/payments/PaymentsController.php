<?php

namespace App\Http\Controllers\payments;

use App\Bill;
use App\Consumer;
use App\Generate_bill;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Session;

class PaymentsController extends Controller
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
            $payments = Payment::
            whereHas('consumer', function ($consumers) {
                $consumers->where('name', 'like', '%' .Input::get('consumer'). '%');
            })
                ->whereDate('created_at', '>=', Input::get('fromdate'))
                ->whereDate('created_at', '<=', Input::get('todate'))
                ->orderBy('id', 'desc')
                ->paginate(Input::get('rows'));
        }
        elseif (Input::has('rows')){
            $payments = Payment::
            whereHas('consumer', function ($consumers) {
                $consumers->where('name', 'like', '%' .Input::get('consumer'). '%');
            })
                ->orderBy('id', 'desc')
                ->paginate(Input::get('rows'));
        }
        else {
            $payments = Payment::orderBy('id', 'desc')->paginate(100);
        }


        return view('payments.index', compact('payments', 'sl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $today = Carbon::now();
        $consumers = Consumer::orderBy('name')->get();
        return view('payments.create', compact('consumers', 'today'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, ['consumer_id' => 'required', 'amount' => 'required', 'user_id' => 'required', 'date' => 'required', ]);

        Payment::create($request->all());

        Session::flash('flash_message', 'Payment added!');

        return redirect('payments');
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
        $payment = Payment::findOrFail($id);

        return view('payments.show', compact('payment'));
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
        $payment = Payment::findOrFail($id);
        $bills = Bill::where('consumer_id', '=',   $payment->consumer->id)
            ->whereNotIn('id', function($q){
                $q->select('bill_id')->from('payments');
            })
            ->get();

        return view('payments.edit', compact('payment', 'bills'));
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
        $this->validate($request, ['consumer_id' => 'required', 'amount' => 'required', 'user_id' => 'required', 'date' => 'required', ]);

        $payment = Payment::findOrFail($id);
        $payment->update($request->all());

        Session::flash('flash_message', 'Payment updated!');

        return redirect('payments');
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
        $payment = Payment::findOrFail($id);

        $payment->delete();

        Session::flash('flash_message', 'Payment deleted!');

        return redirect('payments');
    }
}
