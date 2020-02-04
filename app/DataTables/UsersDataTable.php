<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
						->addColumn('level', function($query) {
							return $query->roles->first()->name;
						})
						->addColumn('action', function($query) {
							return '
								<form action="'.route('user.destroy', $query->id).'" method="post">
									'.csrf_field().'
									'.method_field('DELETE').'
									<a href="'.route('user.edit', $query->id).'" class="btn btn-warning btn-sm" style="margin:1px;">
										Edit
									</a>
									<button type="submit" class="btn btn-danger btn-sm" style="margin:1px;">
										Hapus
									</button>
								</form>
							';
						})
						->rawColumns(['level', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
                    ->setTableId('users-table')
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
						Column::make('username'),
						Column::make('email'),
						Column::make('level'),
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
        return 'Users_' . date('YmdHis');
    }
}
