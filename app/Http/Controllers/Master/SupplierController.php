<?php

namespace App\Http\Controllers\Master;

use App\DataTables\SupplierDataTable;
use App\Http\Controllers\Controller;
use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SupplierDataTable $datatable)
    {
        return $datatable->render('supplier.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('supplier.create');
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
				'company_name' => 'required|string',
				'email' => 'nullable|email|unique:suppliers,email',
				'phone_number' => 'required|numeric|min:0',
				'address' => 'required|string',
				'description' => 'nullable|string'
			]);

			try {
				$supplier = Supplier::firstOrCreate($request->except('_token'));
				session()->flash('success', 'Data Supplier Berhasil di-Tambahkan !');
				return redirect(route('suppliers.index'));
			} catch (\Exception $e) {
				dd($e);
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
				$edit = Supplier::findOrFail($id);
				return view('supplier.edit', compact('edit'));
			} catch (\Exception $e) {
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
				'company_name' => 'required|string',
				'phone_number' => 'required|numeric|min:0',
				'address' => 'required|string',
				'description' => 'nullable|string'
			]);

			try {
				$supplier = Supplier::findOrFail($id);
				if ($request->email != $supplier->email) {
					$this->validate($request, [
						'email' => 'nullable|email|unique:suppliers,email',
					]);
				}
				$supplier->update($request->except('_token', '_method'));
				session()->flash('success', 'Behasil Mengubah Data Supplier !');
				return redirect(route('suppliers.index'));
			} catch (Exception $e) {
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
				$supplier = Supplier::findOrFail($id);
				$supplier->delete();
				session()->flash('success', 'Berhasil Menghapus Data Supplier !');
				return redirect(route('suppliers.index'));
			} catch (\Exception $e) {
				session()->flash('error', 'Terjadi Kesalahan !');
				return redirect()->back();
			}
    }
}
