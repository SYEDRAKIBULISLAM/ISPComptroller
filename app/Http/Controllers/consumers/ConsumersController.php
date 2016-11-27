<?php

namespace App\Http\Controllers\consumers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Consumer;
use App\Package;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Support\Facades\Input;

class ConsumersController extends Controller
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
            if(Input::has('package')){
                $consumers =
                    Consumer::where('name', 'like', '%' .Input::get('name'). '%')
                        ->where('package_id', '=', Input::get('package'))
                        ->where('IP', 'like', '%' .Input::get('IP'). '%')
                        ->whereNotIn('id', function($query){
                            $query->select('id')
                                ->from(with(new Consumer)->getTable())
                                ->whereNotIn('end_date', ['0000-00-00'])
                                ->whereDate('end_date', '<', Carbon::now()->toDateString());
                        })
                        ->sortable()
                        ->paginate(Input::get('rows'));
            }
            else{
                $consumers =
                    Consumer::where('name', 'like', '%' .Input::get('name'). '%')
                        ->where('IP', 'like', '%' .Input::get('IP'). '%')
                        ->whereNotIn('id', function($query){
                            $query->select('id')
                                ->from(with(new Consumer)->getTable())
                                ->whereNotIn('end_date', ['0000-00-00'])
                                ->whereDate('end_date', '<', Carbon::now()->toDateString());
                        })
                        ->sortable()
                        ->paginate(Input::get('rows'));
            }
        }
        else {
            $consumers = Consumer::whereNotIn('id', function($query){
                $query->select('id')
                    ->from(with(new Consumer)->getTable())
                    ->whereNotIn('end_date', ['0000-00-00'])
                    ->whereDate('end_date', '<', Carbon::now()->toDateString());
                })
                ->sortable()->paginate(100);
        }

        $packages = Package::all();
        return view('consumers.index', compact('consumers', 'packages', 'sl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $today = Carbon::now();
        $packages = Package::all();
        return view('consumers.create', compact('today', 'packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'email' => 'email', 'image' => 'mimes:jpg,jpeg,png|Max:1024', 'package_id' => 'required', 'amount' => 'required',  'IP' => 'ip', 'start_date' => 'required', 'user_id' => 'required' ]);
        if ($request->file('image')){
            $temp = $request->file('image');
            $path = 'upload\images';
            $img_name = $temp->getClientOriginalName();
            $dateTime = Carbon::now()->format('Y_m_d_H_i_s_A');
            $full_name = $dateTime.'__'.$img_name;
            $adding = $temp->move($path, $full_name);
            $request->merge(['img_name' => $full_name ]);
        }
        Consumer::create($request->except('image'));

        Session::flash('flash_message', 'Consumer added!');

        return redirect('consumers');
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
        $consumer = Consumer::findOrFail($id);

        return view('consumers.show', compact('consumer'));
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
        $consumer = Consumer::findOrFail($id);

        return view('consumers.edit', compact('consumer'));
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
        $this->validate($request, ['name' => 'required', 'email' => 'email', 'image' => 'mimes:jpg,jpeg,png|Max:1024', 'package_id' => 'required', 'amount' => 'required',  'IP' => 'ip', 'start_date' => 'required', 'user_id' => 'required' ]);

        $consumer = Consumer::findOrFail($id);


        if ($request->file('image')){
            $temp = $request->file('image');
            $path = 'upload\images';
            $img_name = $temp->getClientOriginalName();
            $dateTime = Carbon::now()->format('Y_m_d_H_i_s_A');
            $full_name = $dateTime.'__'.$img_name;
            $adding = $temp->move($path, $full_name);
            $request->merge(['img_name' => $full_name ]);
            unlink($path.'\\'.$consumer->img_name);
        }


        $consumer->update($request->except('image'));

        Session::flash('flash_message', 'Consumer updated!');

        return redirect('consumers');
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

        $consumer = Consumer::findOrFail($id);

        $consumer->delete();

        Session::flash('flash_message', 'Consumer deleted!');

        return redirect('consumers');
    }
    public function printCon($id)
    {

        $consumer = Consumer::findOrFail($id);

        return view('consumers.print', compact('consumer'));
    }
    public function printConsumers()
    {
        $consumers = Consumer::all();

        return view('consumers.consumers', compact('consumers'));
    }
}
