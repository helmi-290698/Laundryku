<?php

namespace App\DataTables;

use App\Models\Itempaket;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ItempaketDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('nama_item', function ($data) {

                return $data->item->name_item;
            })
            ->addColumn('action', function ($data) {
                $csrf =  csrf_token();
                return "<button class='btn btn-warning btn-sm open_modal' value='" . $data->id . "'> edit</button>&nbsp; <button type='button' onclick='deleteItempaket(" . $data->id . ")' class='btn btn-danger btn-sm'>hapus</button>";
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Itempaket $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Itempaket $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('itempaket-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->responsive(true)
            ->autoWidth(false);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::computed('nama_item'),
            Column::make('harga_reguler'),
            Column::make('harga_oneday'),
            Column::make('harga_express'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Itempaket_' . date('YmdHis');
    }
}
