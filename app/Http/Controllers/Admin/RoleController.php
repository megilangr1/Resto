<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
			$roles = Role::orderBy('created_at', 'DESC')->paginate(10);
			return view('admin.roles.index', compact('roles'));
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
					'name' => 'required|string|unique:roles,name'
				]);

				try {
					$roles = Role::firstOrCreate($request->only('name'));

					session()->flash('success', 'Level Akses Berhasil di-Tambah');
					return redirect(route('role.index'));
				} catch (\Exception $e) {
					session()->flash('error', 'Terjadi Kesalahan ! Error Storing Item (Code : xFS01)');
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
					$roles = Role::orderBy('created_at', 'DESC')->paginate(10);
					$edit = Role::findOrFail($id);
					
					return view('admin.roles.index', compact('roles','edit'));
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
        //
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
					$roles = Role::findOrFail($id);
					$roles->delete();

					session()->flash('success', 'Data Berhasil di-Hapus !');
					return redirect(route('role.index'));
				} catch (\Exception $e) {
					session()->flash('error', 'Terjadi Kesalahan !');
					return redirect()->back();
				}
    }
}
