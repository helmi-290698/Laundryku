<?php

namespace App\DataTables;

use App\Models\Consument;
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
            ->filterColumn('nama_item', function ($query, $keyword) {
                $query->whereHas('item', function ($query) use ($keyword) {
                    $sql = "CONCAT(items.name_item) like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                });
            })
            ->addColumn('biaya_laundry', function ($data) {

                return 'Rp ' . number_format($data->biaya_laundry);
            })
            ->filterColumn('biaya_laundry', function ($query, $keyword) {
                $sql = "CONCAT(laundries.biaya_laundry) like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('tipe', function ($data) {

                return '<span class="badge bg-success rounded-pill">' . $data->item->tipelaundry->name_tipe . '</span>';
            })
            ->filterColumn('tipe', function ($query, $keyword) {
                $query->whereHas('item', function ($query2) use ($keyword) {
                    $query2->whereHas('tipelaundry', function ($query2) use ($keyword) {
                        $sql = "CONCAT(tipelaundries.name_tipe) like ?";
                        $query2->whereRaw($sql, ["%{$keyword}%"]);
                    });
                });
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
            ->filterColumn('jumlah', function ($query, $keyword) {
                $sql = "CONCAT(laundries.jumlah) like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('nama_konsumen', function ($data) {

                return "<a href='javascript: void(0);' class='text-muted open-modal-konsumen' data-id='" . $data->pembayaran->consument->id . "' ><i class='fa fa-user'></i> " . $data->pembayaran->consument->name . "</a>";
            })
            ->filterColumn('nama_konsumen', function ($query, $keyword) {
                $query->whereHas('pembayaran', function ($query2) use ($keyword) {
                    $query2->whereHas('consument', function ($query2) use ($keyword) {
                        $sql = "CONCAT(consuments.name) like ?";
                        $query2->whereRaw($sql, ["%{$keyword}%"]);
                    });
                });
            })
            ->addColumn('status', function ($data) {

                if ($data->status == 'antrian') {
                    $raw = "<a href='javascript: void(0);' class='btn btn-primary btn-sm open-modal-status' data-id='" . $data->id . "' ><i class='fas fa-ticket-alt'></i> " . $data->status . "</a>";
                } else if ($data->status == 'cuci') {
                    $raw = "<a href='javascript: void(0);' class='btn btn-warning btn-sm open-modal-status' data-id='" . $data->id . "' ><i class='fas fa-ticket-alt'></i> " . $data->status . "</a>";
                } else if ($data->status == 'setrika') {
                    $raw = "<a href='javascript: void(0);' class='btn btn-warning btn-sm open-modal-status' data-id='" . $data->id . "' ><i class='fas fa-ticket-alt'></i> " . $data->status . "</a>";
                } else if ($data->status == 'packing') {
                    $raw = "<a href='javascript: void(0);' class='btn btn-danger btn-sm open-modal-status' data-id='" . $data->id . "' ><i class='fas fa-ticket-alt'></i> " . $data->status . "</a>";
                } else if ($data->status == 'selesai') {
                    $raw = "<a href='javascript: void(0);' class='btn btn-success btn-sm open-modal-status' data-id='" . $data->id . "' ><i class='fas fa-ticket-alt'></i> " . $data->status . "</a>";
                }
                return $raw;
            })
            ->filterColumn('status', function ($query, $keyword) {
                $sql = "CONCAT(laundries.status) like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('action', function ($data) {
                $csrf = csrf_token();
                if ($data->status == 'antrian') {
                    $data = "<button class='btn btn-primary btn-sm open_modal' value='" . $data->id . "'><i class='fas fa-file-alt' aria-hidden='true'></i></button>&nbsp;<button class='btn btn-warning btn-sm open_modal' value='" . $data->id . "'  ><i class='fas fa-edit' aria-hidden='true'></i></button>&nbsp; <button type='button' onclick='deleteLaundry(" . $data->id . ")' value='" . $csrf . "' class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></button>";
                } else {
                    $data = "<button class='btn btn-primary btn-sm open_modal' value='" . $data->id . "'><i class='fas fa-file-alt' aria-hidden='true'></i></button>&nbsp;<button class='btn btn-warning btn-sm open_modal' value='" . $data->id . "'  disabled><i class='fas fa-edit' aria-hidden='true'></i></button>&nbsp; <button type='button' onclick='deleteLaundry(" . $data->id . ")' value='" . $csrf . "' class='btn btn-danger btn-sm' disabled><i class='fas fa-trash-alt'></i></button>";
                }

                return $data;
            })->rawColumns(['status', 'nama_konsumen', 'tipe', 'jumlah', 'biaya_laundry', 'nama_item', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Laundry $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Laundry $model): QueryBuilder
    {
        // $laundry = laundry::all('consument');

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
            Column::make('nama_konsumen'),
            Column::make('nama_item'),
            Column::make('tipe')
                ->exportable(false)
                ->printable(false)
                ->width(60),
            Column::make('jenis_cucian'),
            Column::make('jumlah'),
            Column::make('biaya_laundry'),
            Column::make('status')
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
