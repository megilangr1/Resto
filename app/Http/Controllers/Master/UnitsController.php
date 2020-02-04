<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Unit;
use Illuminate\Http\Request;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
			$units = Unit::orderBy('created_at', 'DESC')->paginate(10); 
			return view('units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
			$this->validate($request, [
				'name' => 'required|string',
				'short_name' => 'required|string'
			]);

			try {
				$units = Unit::firstOrCreate($request->except('_token'));
				session()->flash('success', 'Berhasil Menambah Data Satuan !');
				return redirect(route('units.index'));
			} catch (\Exception $e) {
				session()->flash('error', 'Terjadi Kesalahan !');
				return redirect()->back();
			}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      try {
				$edit = Unit::findOrFail($id);
				$units = Unit::orderBy('created_at', 'DESC')->paginate(10);
				return view('units.index', compact('edit', 'units'));
			} catch (\Exception $e) {
				session()->flash('error', 'Terjadi Kesalahan !');
				return redirect()->back();
			}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
			$this->validate($request, [
				'name' => 'required|string',
				'short_name' => 'required|string'
			]);

			try {
				$units = Unit::findOrFail($id);
				$units->update($request->except('_token'));

				session()->flash('success', 'Berhasil Melakukan Perubahan Data !');
				return redirect(route('units.index'));
			} catch (\Exception $e) {
				session()->flash('error', 'Terjadi Kesalahan !');
				return redirect()->back();
			}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
					$units = Unit::findOrFail($id);
					$units->delete();
					session()->flash('success', 'Berhasil Menghapus Data !');
					return redirect(route('units.index'));
				} catch (\Exception $th) {
					session()->flash('error', 'Terjadi Kesalahan !');
					return redirect()->back();
				}
    }
}
