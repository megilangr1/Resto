<?php

namespace App\DataTables;

use App\Ingredient;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class IngredientsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
						->eloquent($query)
						->addColumn('unit_id', function($query) {
							return $query->unit->name.' ('.$query->unit->short_name.')';
						})
						->addColumn('price', function($query) {
							return 'Rp. '.number_format($query->price, 0, ',', '.');
						})
						->addColumn('action', function($query) {
							return '
								<form action="'.route('ingredients.destroy', $query->id).'" method="post">
									'.csrf_field().'
									'.method_field('DELETE').'
									<a href="'.route('ingredients.edit', $query->id).'" class="btn btn-warning btn-sm" style="margin:1px;">
										Edit
									</a>
									<button type="submit" class="btn btn-danger btn-sm" style="margin:1px;">
										Hapus
									</button>
								</form>
							';
						})
						->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Ingredient $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Ingredient $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('ingredients-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
						Column::make('id')
							->width('5%')
							->addClass(['text-center']),
						Column::make('name')
							->width('20%'),
						Column::make('description')
							->width('25%'),
						Column::make('price')
							->width('15%'),
						Column::make('unit_id')
							->width('15%'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width('15%')
                  ->addClass(['text-center']),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Ingredients_' . date('YmdHis');
    }
}
