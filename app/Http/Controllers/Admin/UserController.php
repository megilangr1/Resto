<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(UsersDataTable $datatable)
		{
			return $datatable->render('admin.users.index');
			// return view('admin.users.index');
		}

		public function create()
		{
			$roles = Role::orderBy('id', 'ASC')->get();
			return view('admin.users.create', compact('roles'));
		}

		public function store(Request $request)
		{
			$this->validate($request, [
				'name' => 'required|string',
				'username' => 'required|string|min:8|max:16|unique:users,username',
				'email' => 'required|email|unique:users,email',
				'password' => 'required|string|min:8',
				'roles' => 'required|exists:roles,name',
			]);

			try {
				$user = User::firstOrCreate($request->except('_token', 'roles'));
				$user->assignRole($request->roles);

				session()->flash('success', 'Berhasil Menambah Data Pengguna !');
				return redirect(route('user.index'));
			} catch (\Exception $e) {
				dd($e);
				session()->flash('error', 'Terjadi Kesalahan !');
				return redirect()->back();
			}
		}

		public function edit($id)
		{
			try {
				$roles = Role::orderBy('id', 'ASC')->get();
				$edit = User::findOrFail($id);

				return view('admin.users.edit', compact('roles', 'edit'));
			} catch (\Exception $e) {
				return redirect()->back();
			}
		}

		public function update(Request $request, $id)
		{
			$this->validate($request, [
				'name' => 'required|string',
				'username' => 'required|string|min:8|max:16|unique:users,username',
				'email' => 'required|email|unique:users,email',
				'password' => 'nullable|string|min:8',
				'roles' => 'required|exists:roles,name',
			]);
			
			try {
				
			} catch (\Exception $e) {
				return redirect()->back();
			}
		}

		public function destroy($id)
		{
			try {
				$user = User::findOrFail($id);
				$user->delete();

				session()->flash('success', 'Data Pengguna Berhasil di-Hapus !');
				return redirect(route('user.index'));
			} catch (\Exception $e) {
				session()->flash('error', 'Terjadi Kesalahan !');
				return redirect()->back();
			}
		}
}
