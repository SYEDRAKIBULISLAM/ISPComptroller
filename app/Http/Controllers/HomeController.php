<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Consumer;
use App\Generate_bill;
use App\Http\Controllers\Module\DateSettings;
use App\Payment;
use App\Http\Requests;
use App\Start_month;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $thisYear = Carbon::now()->year;
        $thisMonth = Carbon::now()->month;
        $thisDay = Carbon::now()->day;


        $schedule = new DateSettings();

        $fromDate = $schedule->fromDate($thisYear, $thisMonth, $thisDay);

        $toDate = $schedule->toDate($thisYear, $thisMonth, $thisDay);


//        $consumers = Consumer::where(function($query)
//            {
//                $query->whereNotNull('end_date');
//                $query->orWhereDate('end_date', '>=', Carbon::now()->toDateString());
//            })
//            ->get();
//        $clients = Consumer::all();
//        foreach($clients as $item){
//
//        }
//        dd(Carbon::now()->toDateString());
        $consumers = Consumer::whereNotIn('id', function($query){
                $query->select('id')
                    ->from(with(new Consumer)->getTable())
                    ->whereNotIn('end_date', ['0000-00-00'])
                    ->whereDate('end_date', '<', Carbon::now()->toDateString());
            })->get();
        $generate_bill = Generate_bill::where('date', '>=', $fromDate->toDateString())
            ->where('date', '<=', $toDate->toDateString())
            ->first();

        $billId = 0;
        if (isset($generate_bill->id)){
            $billId = $generate_bill->id;
        }


        $totalPaid = Payment::
            whereHas('bill', function ($bill) use ($billId){
                $bill->whereHas('generateBill', function ($billName) use ($billId){
                    $billName->where('id', '=', $billId);
                });
            })
            ->count('id');

        $paidPayments = Payment::
        whereHas('bill', function ($bill) use ($billId) {
            $bill->whereHas('generateBill', function ($billName) use ($billId){
                $billName->where('id', '=', $billId);
            });
        })
            ->orderBy('id', 'desc')
            ->get();
        $duePayments = Bill::
            whereHas('generateBill', function ($billName) use ($billId){
                $billName->where('id', '=', $billId);
            })
            ->whereNotIn('id', function($q){
                $q->select('bill_id')->from('payments');
            })
            ->orderBy('id', 'desc')
            ->get();

        $todayPaid = Payment::whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))
            ->count('id');

        $totalBillAmount = Bill::
        whereHas('generateBill', function ($billName) use ($billId){
            $billName->where('id', '=', $billId);
        })
            ->sum('amount');

        $totalReceive = Payment::
        whereHas('bill', function ($bill) use ($billId){
            $bill->whereHas('generateBill', function ($billName) use ($billId){
                $billName->where('id', '=', $billId);
            });
        })
            ->sum('amount');
        $totalDiscount = Payment::
        whereHas('bill', function ($bill) use ($billId){
            $bill->whereHas('generateBill', function ($billName) use ($billId){
                $billName->where('id', '=', $billId);
            });
        })
            ->sum('discount');
        $todayReceive = Payment::
        whereHas('bill', function ($bill) use ($billId){
            $bill->whereHas('generateBill', function ($billName) use ($billId){
                $billName->where('id', '=', $billId);
            });
        })
            ->whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))
            ->sum('amount');

        $payments = Payment::all();
        return view('home', compact('consumers', 'fromDate', 'toDate', 'generate_bills', 'totalPaid', 'paidPayments', 'duePayments', 'todayPaid', 'totalBillAmount', 'totalReceive', 'totalDiscount', 'todayReceive'));
    }
}

