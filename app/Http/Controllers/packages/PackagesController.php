<?php

namespace App\Http\Controllers\packages;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Package;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Session;

class PackagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
//        if (Input::has('order')){
//            $packages = Package::where('name', 'like', '%' .Input::get('name'). '%')->orderBy('id', 'desc')->paginate(Input::get('rows'));
//        }
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
            $packages = Package::where('name', 'like', '%' .Input::get('name'). '%')->orderBy('id', Input::get('order'))->paginate(Input::get('rows'));
        }
        else {
            $packages = Package::orderBy('id', 'desc')->paginate(100);
        }

        return view('packages.index', compact('packages', 'sl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('packages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'bandwidth' => 'required', ]);

        Package::create($request->all());

        Session::flash('flash_message', 'Package added!');

        return redirect('packages');
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
        $package = Package::findOrFail($id);

        return view('packages.show', compact('package'));
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
        $package = Package::findOrFail($id);

        return view('packages.edit', compact('package'));
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
        $this->validate($request, ['name' => 'required', 'bandwidth' => 'required', ]);

        $package = Package::findOrFail($id);
        $package->update($request->all());

        Session::flash('flash_message', 'Package updated!');

        return redirect('packages');
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
        $package = Package::findOrFail($id);

        $package->delete();

        Session::flash('flash_message', 'Package deleted!');

        return redirect('packages');

    }
}
