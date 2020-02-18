<?php

namespace App\Http\Controllers\Master;

use App\DataTables\IngredientsDataTable;
use App\Http\Controllers\Controller;
use App\Ingredient;
use App\StockIngredient;
use App\Unit;
use Illuminate\Http\Request;

class IngredientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IngredientsDataTable $datatable)
    {
        return $datatable->render('ingredient.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
				$units = Unit::orderBy('name')->get();
        return view('ingredient.create', compact('units'));
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
					'name' => 'required|string|max:191',
					'description' => 'nullable|string',
					'price' => 'required|numeric|min:0',
					'unit_id' => 'required|string|exists:units,id'
				]);

				if ($request->stock_modal) {
					$this->validate($request, [
						'first_stock' => 'numeric|required|min:1',
					]);
				}

				try {
					$ingredients = Ingredient::firstOrCreate($request->except('_token', 'stock_modal', 'first_stock'));
					$stockIngredient = StockIngredient::firstOrCreate([
						'ingredient_id' => $ingredients->id,
						'first_stock' => $request->first_stock,
						'stock_in' => 0,
						'stock_out' => 0,
						'stock_adjustment' => 0 
					]);
					session()->flash('success', 'Berhasil Menambah Data Bahan Pokok !');
					return redirect(route('ingredients.index'));
				} catch (\Exception $e) {
					session()->flash('error', 'Terjadi Kesalahan ! '.$e);
					return redirect()->back();
				}
				dd($request->all());
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
					$edit = Ingredient::findOrFail($id);
					$units = Unit::orderBy('name')->get();
					return view('ingredient.edit', compact('edit', 'units'));
				} catch (\Exception $th) {
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
					'name' => 'required|string|max:191',
					'description' => 'nullable|string',
					'price' => 'required|numeric|min:0',
					'unit_id' => 'required|string|exists:units,id'
				]);

				try {
					$ingredients = Ingredient::findOrFail($id);
					$ingredients->update($request->except('_token', '_method'));
					session()->flash('success', 'Berhasil Mengubah Data Bahan Pokok !');
					return redirect(route('ingredients.index'));
				} catch (\Exception $e) {
					session()->flash('error', 'Terjadi Kesalahan ! '.$e);
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
					$ingredients = Ingredient::findOrFail($id);
					// dd($ingredients->stock);
					if ($ingredients->stock != null) {
						StockIngredient::find($ingredients->stock->id)->delete();
					}
					$ingredients->delete();
					session()->flash('success', 'Berhasil Menghapus Data Bahan Pokok !');
					return redirect(route('ingredients.index'));
				} catch (\Exception $e) {
					session()->flash('error', 'Terjadi Kesalahan ! '.$e);					
					return redirect()->back();
				}
    }
}
