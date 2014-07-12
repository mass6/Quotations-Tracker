<?php

use Insight\Entities\Supplier;
use Insight\Entities\User;


class SuppliersController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return View::make('suppliers.index', compact('suppliers'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('suppliers.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $supplier = new Supplier(Input::all());
        if (! $supplier->save())
        {
            return Redirect::back()->withInput()->withErrors($supplier->getErrors());
        }
        else
        {
            return Redirect::route('suppliers.index')
                ->with('flash_message', 'Supplier was successfully created.')
                ->with('success', true);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return View::make('suppliers.edit', compact('supplier'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = Input::all();
        $supplier = Supplier::find($id);
        if (! $supplier->update($input))
        {
            return Redirect::back()->withInput()->withErrors($supplier->getErrors());
        }
        else
        {
            return Redirect::route('suppliers.index')
                ->with('flash_message', 'Supplier was successfully updated.')
                ->with('success', true);
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Supplier::find($id)->delete();
        return Redirect::route('supplier.index');
    }


}
