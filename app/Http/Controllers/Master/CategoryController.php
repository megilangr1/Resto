<?php

namespace App\Http\Controllers\Master;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
			$categories = Category::orderBy('created_at', 'DESC')->paginate(5);
      return view('category.index', compact('categories'));
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
				'description' => 'nullable|string'
			]);

			try {
				$categories =Category::firstOrCreate($request->except('_token'));
				session()->flash('success', 'Berhasil Menambah Data Satuan !');
				return redirect(route('category.index'));
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
				$edit = Category::findOrFail($id);
				$categories = Category::orderBy('created_at', 'DESC')->paginate(5);
				return view('category.index', compact('edit', 'categories'));
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
				'description' => 'nullable|string'
			]);

			try {
				$category = Category::findOrFail($id);
				$category->update($request->except('_token'));

				session()->flash('success', 'Berhasil Melakukan Perubahan Data !');
				return redirect(route('category.index'));
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
				$categories = Category::findOrFail($id);
				$categories->delete();
				session()->flash('success', 'Berhasil Menghapus Data !');
				return redirect(route('category.index'));
			} catch (\Exception $th) {
				session()->flash('error', 'Terjadi Kesalahan !');
				return redirect()->back();
			}
    }
}
