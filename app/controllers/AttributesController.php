<?php
use Insight\Entities\Attribute;

class AttributesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $attributes = Attribute::all();
		return View::make('attributes.index', compact('attributes'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('attributes.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $input = Input::all();

        // myInputs[] does not map to a table column, so the values
        // need to be converted to JSON for storing in the
        // values column, then myInputs need to be unset from
        // the $input[] array
        if($input['type'] === 'select')
        {
            if (! isset($input['myInputs'])) {
                // TODO : throw exception
            }
            $myInputs = $input['myInputs'];
            $input['values'] = json_encode($myInputs);
        }
        else
        {
            $input['values'] = null;
        }
        unset($input['myInputs']);

		$attribute = new Attribute($input);
		if (! $attribute->save())
		{
			return Redirect::back()->withInput()->withErrors($attribute->getErrors());
		}
		else
		{
			return Redirect::route('attributes.index')
			->with('flash_message', 'Attribute was successfully created.')
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
		$attribute = Attribute::find($id);
//        return json_decode($attribute->values);
		return View::make('attributes.edit', compact('attribute', 'vals'));
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

        return $input;
        // myInputs[] does not map to a table column, so the values
        // need to be converted to JSON for storing in the
        // values column, then myInputs need to be unset from
        // the $input[] array
        if($input['type'] === 'select')
        {
            $myInputs = $input['myInputs'];
            $input['values'] = json_encode($myInputs);
        }
        else
            // delete any previous values stored in 'values' index
        {
            $input['values'] = null;
        }
        unset($input['myInputs']);

		$attribute = Attribute::find($id);
		if (! $attribute->update($input))
		{
			return Redirect::back()->withInput()->withErrors($attribute->getErrors());
		}
		else
		{
			return Redirect::route('attributes.index')
			->with('flash_message', 'Attribute was successfully updated.')
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
		Attribute::find($id)->delete();
		return Redirect::route('attributes.index');
	}


}
