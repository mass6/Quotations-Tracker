<?php

use Insight\Entities\Customer;

class CustomersController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $customers = Customer::all();
        return View::make('customers.index', compact('customers'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('customers.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $customer = new Customer(Input::except('layout'));
        if (! $customer->save())
        {
            return Redirect::back()->withInput()->withErrors($customer->getErrors());
        }
        else
        {
            if (Input::has('layout')){
                Config::set('view.layout.customer.emrill', 'main');
            }
            return Redirect::route('customers.index')
                ->with('flash_message', 'Customer was successfully created.')
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
        $customer = Customer::find($id);
        return View::make('customers.edit', compact('customer'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = Input::except('layout');
        $customer = Customer::find($id);
        if (! $customer->update($input))
        {
            return Redirect::back()->withInput()->withErrors($customer->getErrors());
        }
        else
        {
            if (Input::has('layout')){
                Config::set('view.layout.customer.emrill', 'main');
                Log::info('Layout: ' . Config::get('view.layout.customer.' . $customer->code));
            }

            return Redirect::route('customers.index')
                ->with('flash_message', 'Customer was successfully updated.')
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
        Customer::find($id)->delete();
        return Redirect::route('customers.index');
    }


}
