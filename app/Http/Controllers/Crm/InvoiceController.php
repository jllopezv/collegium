<?php

namespace App\Http\Controllers\Crm;

use App\Models\Crm\Invoice;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\HasCommon;

class InvoiceController extends Controller
{
    use HasCommon;

    protected $table='invoices';
    protected $module='crm';
    protected $model=Invoice::class;
    protected $title;
    protected $subtitle;

    public function __construct()
    {
        $this->title=transup('tables.'.$this->table);
        $this->subtitle='Facturas';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ($this->commonIndex($options??[]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return ($this->commonCreate($options??[]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ($this->commonShow($id, $options??[]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return ($this->commonEdit($id, $options??[]));
    }



    public function createCustomers($customer_id)
    {
        $this->checkHasAbilityCreate();
        $params=[
            'title'     =>  $this->title,
            'subtitle'  =>  $this->subtitle,
            'table'     =>  $this->table,
            'model'     =>  $this->model,
            'invoice_source'    => 'customers',
            'invoice_source_id' =>  $customer_id,
            'hideselectsource'  => true,
        ];
        return view('models.'.$this->module.'.'.$this->table.'.create', $params); // Create View
    }

    public function createSuppliers($supplier_id)
    {
        $this->checkHasAbilityCreate();
        $params=[
            'title'     =>  $this->title,
            'subtitle'  =>  $this->subtitle,
            'table'     =>  $this->table,
            'model'     =>  $this->model,
            'invoice_source'    => 'suppliers',
            'invoice_source_id' =>  $supplier_id,
            'hideselectsource'  => true,
        ];
        return view('models.'.$this->module.'.'.$this->table.'.create', $params); // Create View
    }
}
