<?php

namespace App\DataTables;

use App\Product;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
{
  /**
   * Build DataTable class.
   *
   * @param mixed $query Results from query() method.
   * @return \Yajra\DataTables\DataTableAbstract
   */
  public function dataTable($query)
  {
    return datatables($query)
      ->setRowId('id')
      // ->addColumn('action', 'products.action');
      ->editColumn('msrp', function ($data) {
        return number_format($data->msrp, 2);
      })
      ->editColumn('wholesale', function ($data) {
        return number_format($data->wholesale, 2);
      });
  }

  /**
   * Get query source of dataTable.
   *
   * @param \App\Product $model
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function query(Product $model)
  {
    return $model->newQuery()->select(
      'id',
      'upc',
      'type',
      'category',
      'product',
      'description',
      'msrp',
      'wholesale'
      // 'created_at',
      // 'updated_at'
    );
  }

  /**
   * Optional method if you want to use html builder.
   *
   * @return \Yajra\DataTables\Html\Builder
   */
  public function html()
  {
    return $this->builder()
      ->columns($this->getColumns())
      ->minifiedAjax()
      // ->addAction(['width' => '80px'])
      ->parameters([
        'table' => 'products',
        'paging' => true,
        // 'pagingType' => 'first_last_numbers',
        'searching' => true,
        'dom' => 'Bfrtlip',
        'order' => [1, 'asc'],
        'select' => [
          'style' => 'os',
          'selector' => 'td:first-child',
        ],
        'buttons' => [
          ['extend' => 'create', 'editor' => 'editor'],
          ['extend' => 'edit', 'editor' => 'editor'],
          ['extend' => 'remove', 'editor' => 'editor'],
          [
            'extend' => 'collection',
            'text' => 'Export',
            'buttons' => [
              'copy',
              'excel',
              'csv',
              'pdf',
              'print'
            ]
          ]
        ],
        "lengthMenu" => [[10, 25, 50, -1], [10, 25, 50, "All"]],
      ]);
  }

  /**
   * Get columns.
   *
   * @return array
   */
  protected function getColumns()
  {
    return [
      [
        'idSrc' => 'id',
        'data' => null,
        'defaultContent' => '',
        'className' => 'select-checkbox',
        'title' => '',
        'orderable' => false,
        'searchable' => false
      ],
      // 'id',
      'upc',
      'type',
      'category',
      'product',
      'description',
      'msrp',
      "wholesale",
      // 'created_at',
      // 'updated_at',

    ];
  }

  /**
   * Get filename for export.
   *
   * @return string
   */
  protected function filename()
  {
    return 'Products_' . date('YmdHis');
  }
}