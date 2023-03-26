<?php

namespace App\DataTables;

use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PembayaranDataTable extends DataTable
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

            ->addColumn('nama_konsumen', function ($data) {

                return $data->consument->name;
            })
            ->filterColumn('nama_konsumen', function ($query, $keyword) {
                $query->whereHas('consument', function ($query) use ($keyword) {
                    $sql = "CONCAT(consuments.name) like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                });
            })
            ->addColumn('total_biaya', function ($data) {

                return 'Rp ' . number_format($data->total_biaya);
            })
            ->addColumn('diskon', function ($data) {

                return 'Rp ' . number_format($data->diskon);
            })
            ->addColumn('biaya_lainya', function ($data) {

                return 'Rp ' . number_format($data->biaya_lainya);
            })
            ->addColumn('status', function ($data) {

                if ($data->status == 'unpaid') {
                    $raw = "<a href='javascript: void(0);' class='btn btn-danger btn-sm open-modal-status' data-id='" . $data->id . "' ><i class='fas fa-ticket-alt'></i> " . $data->status . "</a>";
                } else {
                    $raw = "<a href='javascript: void(0);' class='btn btn-success btn-sm open-modal-status' data-id='" . $data->id . "' ><i class='fas fa-ticket-alt'></i> " . $data->status . "</a>";
                }
                return $raw;
            })
            ->filterColumn('status', function ($query, $keyword) {
                $sql = "CONCAT(pembayarans.status) like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('action', function ($data) {
                $csrf = csrf_token();
                return "<a href='/pembayaran/invoice/" . $data->id . "' class='btn btn-primary btn-sm'><i class='fas fa-file-invoice-dollar' aria-hidden='true'></i></a>&nbsp; <button type='button' onclick='deletePembayaran(" . $data->id . ")'  class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></button></button>";
            })
            ->rawColumns(['status', 'nama_konsumen', 'total_biaya', 'diskon', 'biaya_lainya', 'action'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Pembayaran $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pembayaran $model): QueryBuilder
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
            ->setTableId('pembayaran-table')
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
            Column::make('nama_konsumen'),
            Column::make('total_biaya'),
            Column::make('diskon'),
            Column::make('biaya_lainya'),
            Column::make('status'),
            Column::make('tanggal_masuk'),
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
        return 'Pembayaran_' . date('YmdHis');
    }
}
