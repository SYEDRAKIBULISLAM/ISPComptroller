<?php

/**
 * Created by PhpStorm.
 * User: Romeo
 * Date: 8/4/2016
 * Time: 2:03 PM
 */

namespace App\Http\Controllers\report;

use App\Bill;
use App\Consumer;
use App\Expence;
use App\Generate_bill;
use App\Http\Controllers\Module\DateSettings;
use App\Payment;
use App\Http\Requests;
use App\Start_month;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class reportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function bill()
    {
        $sl = 0;
        if(Input::has('page')){
            if(Input::has('rows')) {
                $sl += (Input::get('page') - 1) * Input::get('rows');
            }
        }
        if (Input::has('bill')){
            $billGenerate = Generate_bill::findOrFail(Input::get('bill'));

            if(!isset($billGenerate->id)){
                return view('errors.error');
            }

            $thisYear = Carbon::parse($billGenerate)->format('Y');
            $thisMonth = Carbon::parse($billGenerate)->format('m');
            $thisDay = Carbon::parse($billGenerate)->format('d');
            $bills = Bill::
                whereHas('generateBill', function ($BillGenerate) {
                    $BillGenerate->where('id', '=', Input::get('bill'));
                })
                ->orderBy('id', 'desc')
                ->paginate(Input::get('rows'));
        }
        elseif (Input::has('rows')){
            $billGenerate = Generate_bill::orderBy('date', 'desc')->first();

            if(!isset($billGenerate->id)){
                return view('errors.error');
            }

            $thisYear = Carbon::parse($billGenerate->date)->format('Y');
            $thisMonth = Carbon::parse($billGenerate->date)->format('m');
            $thisDay = Carbon::parse($billGenerate->date)->format('d');

            $bills = Bill::whereHas('generateBill', function ($BillGenerate) use($billGenerate) {
                $BillGenerate->where('id', '=', $billGenerate->id);
            })
                ->orderBy('id', 'desc')
                ->paginate(Input::get('rows'));
        }
        else {
            $billGenerate = Generate_bill::orderBy('date', 'desc')->first();

            if(!isset($billGenerate->id)){
                return view('errors.error');
            }
            $thisYear = Carbon::parse($billGenerate->date)->format('Y');
            $thisMonth = Carbon::parse($billGenerate->date)->format('m');
            $thisDay = Carbon::parse($billGenerate->date)->format('d');

            $billsCount = Bill::count('id');

            $bills = Bill::orderBy('id', 'desc')
                ->whereHas('generateBill', function ($BillGenerate) use($billGenerate){
                    $BillGenerate->where('id', '=', $billGenerate->id);
                })
                ->paginate($billsCount);
        }

        $schedule = new DateSettings();
        $fromDate = $schedule->fromDate($thisYear, $thisMonth, $thisDay);
        $toDate = $schedule->toDate($thisYear, $thisMonth, $thisDay);

        $generateBills = Generate_bill::orderBy('id', 'desc')->get();


        return view('report.bill', compact('bills','generateBills', 'fromDate', 'toDate', 'sl'));
    }

    public function payment()
    {
        $sl = 0;
        if(Input::has('page')){
            if(Input::has('rows')) {
                $sl += (Input::get('page') - 1) * Input::get('rows');
            }
        }
        if (Input::has('bill')){
            $billGenerate = Generate_bill::findOrFail(Input::get('bill'));

            if(!isset($billGenerate->id)){
                return view('errors.error');
            }

            $thisYear = Carbon::parse($billGenerate)->format('Y');
            $thisMonth = Carbon::parse($billGenerate)->format('m');
            $thisDay = Carbon::parse($billGenerate)->format('d');

            $payments = Payment::whereHas('bill', function ($Bill) {
                $Bill->whereHas('generateBill', function ($BillGenerate) {
                    $BillGenerate->where('id', '=', Input::get('bill'));
                });
            })
                ->orderBy('id', 'desc')
                ->paginate(Input::get('rows'));
        }
        elseif (Input::has('rows')){
            $billGenerate = Generate_bill::orderBy('date', 'desc')->first();

            if(!isset($billGenerate->id)){
                return view('errors.error');
            }

            $thisYear = Carbon::parse($billGenerate->date)->format('Y');
            $thisMonth = Carbon::parse($billGenerate->date)->format('m');
            $thisDay = Carbon::parse($billGenerate->date)->format('d');

            $payments = Payment::whereHas('bill', function ($Bill) use($billGenerate){
                $Bill->whereHas('generateBill', function ($BillGenerate) use($billGenerate){
                    $BillGenerate->where('id', '=', $billGenerate->id);
                });
            })
                ->orderBy('id', 'desc')
                ->paginate(Input::get('rows'));
        }
        else {
            $billGenerate = Generate_bill::orderBy('date', 'desc')->first();
            if(!isset($billGenerate->id)){
                return view('errors.error');
            }
            $thisYear = Carbon::parse($billGenerate->date)->format('Y');
            $thisMonth = Carbon::parse($billGenerate->date)->format('m');
            $thisDay = Carbon::parse($billGenerate->date)->format('d');

            $paymentCount = Payment::count('id');

            $payments = Payment::whereHas('bill', function ($Bill) use($billGenerate){
                    $Bill->whereHas('generateBill', function ($BillGenerate) use($billGenerate){
                        $BillGenerate->where('id', '=', $billGenerate->id);
                    });
                })
                ->orderBy('id', 'desc')
                ->paginate($paymentCount+1);
        }

        $schedule = new DateSettings();
        $fromDate = $schedule->fromDate($thisYear, $thisMonth, $thisDay);
        $toDate = $schedule->toDate($thisYear, $thisMonth, $thisDay);

        $generateBills = Generate_bill::orderBy('id', 'desc')->get();

        return view('report.payment', compact('payments', 'generateBills', 'fromDate', 'toDate', 'sl'));
    }

    public function statement()
    {
        $sl = 0;
        if(Input::has('page')){
            if(Input::has('rows')) {
                $sl += (Input::get('page') - 1) * Input::get('rows');
            }
        }
        if (Input::has('rows')){
            $payments = Payment::
            whereHas('consumer', function ($consumers) {
                $consumers->where('name', 'like', '%' .Input::get('consumer'). '%');
            })
                ->orderBy('id', 'desc')
                ->paginate(Input::get('rows'));
            $bills = Bill::
            whereHas('consumer', function ($consumers) {
                $consumers->where('name', 'like', '%' .Input::get('consumer'). '%');
            })
                ->orderBy('id', 'desc')
                ->paginate(Input::get('rows'));
            $consumers = Consumer::where('name', 'like', '%' .Input::get('consumer'). '%')
                ->orderBy('id', 'desc')
                ->paginate(Input::get('rows'));
        }
        else {

            $consumerCount = Consumer::count('id');

            $bills = Bill::orderBy('id', 'desc')
                ->paginate($consumerCount+1);
            $payments = Payment::orderBy('id', 'desc')
                ->paginate($consumerCount+1);
            $consumers = Consumer::orderBy('id', 'desc')
                ->paginate($consumerCount+1);


        }
        $today = Carbon::now();

        $generateBills = Generate_bill::orderBy('id', 'desc')->get();

        return view('report.statement', compact('bills', 'payments', 'consumers', 'generateBills', 'today', 'sl'));
    }
    public function account_statement(){


        if (Input::has('bill')){
            $billGenerate = Generate_bill::findOrFail(Input::get('bill'));
            if(!isset($billGenerate->id)){
                return view('errors.error');
            }
            $thisYear = Carbon::parse($billGenerate->date)->format('Y');
            $thisMonth = Carbon::parse($billGenerate->date)->format('m');
            $thisDay = Carbon::parse($billGenerate->date)->format('d');

            $schedule = new DateSettings();
            $fromDate = $schedule->fromDate($thisYear, $thisMonth, $thisDay);
            $toDate = $schedule->toDate($thisYear, $thisMonth, $thisDay);

            $expences = Expence::whereDate('date', '>=', $fromDate->format('Y-m-d'))
                ->whereDate('date', '<=', $toDate->format('Y-m-d'))
                ->get();
            $payments = Payment::whereHas('bill', function ($Bill) use($billGenerate){
                $Bill->whereHas('generateBill', function ($BillGenerate) use($billGenerate){
                    $BillGenerate->where('id', '=', $billGenerate->id);
                });
            })
                ->get();
            $expLength = count($expences);
            $payLength = count($payments);


            if ($payLength >= $expLength){
                $max = $payLength;
            }
            else {
                $max = $expLength;
            }
        }
        else {
            $billGenerate = Generate_bill::orderBy('date', 'desc')->first();
            if(!isset($billGenerate->id)){
                return view('errors.error');
            }
            $thisYear = Carbon::parse($billGenerate->date)->format('Y');
            $thisMonth = Carbon::parse($billGenerate->date)->format('m');
            $thisDay = Carbon::parse($billGenerate->date)->format('d');

            $schedule = new DateSettings();
            $fromDate = $schedule->fromDate($thisYear, $thisMonth, $thisDay);
            $toDate = $schedule->toDate($thisYear, $thisMonth, $thisDay);

            $expences = Expence::whereDate('date', '>=', $fromDate->format('Y-m-d'))
                                ->whereDate('date', '<=', $toDate->format('Y-m-d'))
                                ->get();
            $payments = Payment::whereHas('bill', function ($Bill) use($billGenerate){
                $Bill->whereHas('generateBill', function ($BillGenerate) use($billGenerate){
                    $BillGenerate->where('id', '=', $billGenerate->id);
                });
            })
                ->get();
            $expLength = count($expences);
            $payLength = count($payments);


            if ($payLength >= $expLength){
                $max = $payLength;
            }
            else {
                $max = $expLength;
            }
        }


        $paginate = Generate_bill::count('id');
        $generateBills = Generate_bill::orderBy('id', 'desc')->paginate($paginate+1);



        return view('report.account_statement', compact('generateBills', 'expences', 'payments', 'max', 'fromDate', 'toDate'));
    }
}

