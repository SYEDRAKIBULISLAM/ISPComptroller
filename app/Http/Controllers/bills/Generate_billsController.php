<?php

namespace App\Http\Controllers\bills;

use App\Bill;
use App\Consumer;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Generate_bill;
use App\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Input;

class Generate_billsController extends Controller
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
        if(Input::has('rows')){
            $generate_bills = Generate_bill::where('name', 'like', '%' .Input::get('name'). '%')->where('date', 'like', '%' .Input::get('year'). '%')->paginate(Input::get('rows'));
        }
        else {
            $generate_bills = Generate_bill::orderBy('id', 'desc')->paginate(100);
        }


        return view('bills.generate_bills.index', compact('generate_bills', 'sl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $today = Carbon::now();
        return view('bills.generate_bills.create', compact('today'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'date' => 'required', 'user_id' => 'required', ]);

        $newBill = Generate_bill::create($request->all());

        $consumers = Consumer::all();
        foreach($consumers as $consumer){
            $payment = Payment::where('consumer_id', '=', $consumer->id)->orderBy('id', 'desc')->first();
            if(isset($payment->due)){
                $bilAmount = $consumer->amount + $payment->due;
            }
            else {
                $bilAmount =  $consumer->amount;
            }

            $endDate = strtotime($consumer->end_date);
            if($endDate != 0){
                if($endDate > strtotime($newBill->date)){
                    Bill::create(['consumer_id' => $consumer->id, 'generate_bill_id' => $newBill->id, 'user_id' => $request->user_id, 'amount' => $bilAmount]);
                }
            }
            else {
                Bill::create(['consumer_id' => $consumer->id, 'generate_bill_id' => $newBill->id, 'user_id' => $request->user_id, 'amount' => $bilAmount]);
            }
        }


        Session::flash('flash_message', 'Bill Generator added!');

        return redirect('bills/generate_bills');
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
        $generate_bill = Generate_bill::findOrFail($id);

        return view('bills.generate_bills.show', compact('generate_bill'));
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
        $generate_bill = Generate_bill::findOrFail($id);

        return view('bills.generate_bills.edit', compact('generate_bill'));
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
        $this->validate($request, ['name' => 'required', 'date' => 'required', 'user_id' => 'required', ]);

        $generate_bill = Generate_bill::findOrFail($id);
        $generate_bill->update($request->all());


        Session::flash('flash_message', 'Bill Generator updated!');

        return redirect('bills/generate_bills');
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
        $generate_bill = Generate_bill::findOrFail($id);

        $generate_bill->delete();

        $bill = Bill::where('generate_bill_id', '=', $id)->delete();

//        $bill->delete();

        Session::flash('flash_message', 'Bill Generator deleted!');

        return redirect('bills/generate_bills');
    }
}
