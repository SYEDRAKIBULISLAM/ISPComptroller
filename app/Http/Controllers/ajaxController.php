<?php

namespace App\Http\Controllers;

use App\Bill;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class ajaxController extends Controller
{
    function showBill(){
        $bills = Bill::where('consumer_id', '=', Input::get('consumer_id'))
            ->whereNotIn('id', function($q){
                $q->select('bill_id')->from('payments');
            })
            ->get();
        return view('ajax/bills', compact('bills'));
    }
    function showBillUseID(){
        $bills = Bill::where('consumer_id', '=', Input::get('consumer_id'))
            ->whereNotIn('id', function($q){
                $q->select('bill_id')->from('payments');
            })
            ->get();
        return view('ajax/billsUseID', compact('bills'));
    }
}
