<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ProductsDataTable;
use App\DataTables\ProductsDataTablesEditor;

class ProductsController extends Controller
{
    public function show(ProductsDataTable $dataTable)
    {
        return $dataTable->render('products.index');
    }

    public function index(ProductsDataTable $dataTable)
    {
        return $dataTable->render('products.index');
    }

    public function store(ProductsDataTablesEditor $editor)
    {
        return $editor->process(request());
    }
}