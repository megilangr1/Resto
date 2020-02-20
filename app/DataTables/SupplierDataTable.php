<?php

namespace App\DataTables;

use App\Supplier;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SupplierDataTable extends DataTable
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
						->addColumn('phone_number', function($query) {
							return '(+62) '.$query->phone_number;
						})
						->addColumn('action', function($query) {
							return '
								<form action="'.route('suppliers.destroy', $query->id).'" method="post">
									'.csrf_field().'
									'.method_field('DELETE').'
									<a href="'.route('suppliers.edit', $query->id).'" class="btn btn-warning btn-sm" style="margin:1px;">
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
     * @param \App\Supplier $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Supplier $model)
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
                    ->setTableId('supplier-table')
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
            Column::make('id'),
						Column::make('name'),
						Column::make('company_name'),
						Column::make('phone_number'),
						Column::make('address'),
						Column::make('description')
							->width('15%'),
						Column::computed('action')
							->exportable(false)
							->printable(false)
							->width('15%')
							->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Supplier_' . date('YmdHis');
    }
}
