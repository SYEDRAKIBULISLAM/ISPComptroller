<?php

namespace App\Http\Controllers\request;

use App\Consumer;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Consumer_request;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Session;

class Consumer_requestsController extends Controller
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
        if (Input::has('rows')){
            $consumer_requests = Consumer_request::
            whereHas('consumer', function ($consumers) {
                $consumers->where('name', 'like', '%' .Input::get('consumer'). '%');
            })
                ->where('date', 'like', '%' .Input::get('date'). '%')
                ->orderBy('id', 'desc')
                ->paginate(Input::get('rows'));
        }
        else {
            $consumer_requests = Consumer_request::orderBy('id', 'desc')->paginate(100);
        }


        return view('consumer_requests.index', compact('consumer_requests', 'sl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $consumers = Consumer::all();
        $today = Carbon::now();
        return view('consumer_requests.create', compact('consumers', 'today'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, ['consumer_id' => 'required', 'note' => 'required', 'date' => 'required', 'user_id' => 'required' ]);

        Consumer_request::create($request->all());

        Session::flash('flash_message', 'Request added!');

        return redirect('consumer_requests');
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
        $consumer_request = Consumer_request::findOrFail($id);

        return view('consumer_requests.show', compact('consumer_request'));
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
        $consumer_request = Consumer_request::findOrFail($id);

        return view('consumer_requests.edit', compact('consumer_request'));
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
        $this->validate($request, ['consumer_id' => 'required', 'note' => 'required', 'date' => 'required', ]);

        $consumer_request = Consumer_request::findOrFail($id);
        $consumer_request->update($request->all());

        Session::flash('flash_message', 'Request updated!');

        return redirect('consumer_requests');
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
        Consumer_request::destroy($id);

        Session::flash('flash_message', 'Request deleted!');

        return redirect('consumer_requests');
    }
}
