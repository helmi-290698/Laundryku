<?php

namespace App\DataTables;

use App\Models\Laundry;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LaundryDataTable extends DataTable
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
            ->addColumn('tipe', function ($data) {

                return $data->item->tipelaundry->name_tipe;
            })
            ->addColumn('jumlah', function ($data) {

                $cucian = $data->item->hitungan;

                if ($cucian == "permeter") {
                    $atribut = "Meter";
                } else if ($cucian == "perkilo") {
                    $atribut = "Kg";
                } else if ($cucian == "peritem") {
                    $atribut = "item";
                }

                return $data->jumlah . " " . $atribut;
            })
            ->addColumn('nama_konsumen', function ($data) {

                return $data->consument->name;
            })
            ->addColumn('status', function ($data) {

                if ($data->status == 'antrian') {
                    $raw = "<button class='btn btn-primary btn-sm'>" . $data->status . "</button>";
                } else if ($data->status == 'cuci') {
                    $raw = "<button class='btn btn-warning btn-sm'>" . $data->status . "</button>";
                } else if ($data->status == 'setrika') {
                    $raw = "<button class='btn btn-warning btn-sm'>" . $data->status . "</button>";
                } else if ($data->status == 'packing') {
                    $raw = "<button class='btn btn-danger btn-sm'>" . $data->status . "</button>";
                } else if ($data->status == 'selsai') {
                    $raw = "<button class='btn btn-success btn-sm'>" . $data->status . "</button>";
                }
                return $raw;
            })
            ->addColumn('action', function ($data) {

                return "<button class='btn btn-warning btn-sm open_modal' value='" . $data->id . "'> edit</button>&nbsp; <button type='button' onclick='deleteItempaket(" . $data->id . ")' class='btn btn-danger btn-sm'>hapus</button>";
            })->rawColumns(['status', 'nama_konsumen', 'tipe', 'jumlah', 'nama_item', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Laundry $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Laundry $model): QueryBuilder
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
            ->setTableId('laundry-table')
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
            Column::make('id'),
            Column::computed('nama_konsumen'),
            Column::computed('nama_item'),
            Column::computed('tipe'),
            Column::make('jenis_cucian'),
            Column::computed('jumlah'),
            Column::make('total_biaya'),
            Column::computed('status')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
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
        return 'Laundry_' . date('YmdHis');
    }
}
