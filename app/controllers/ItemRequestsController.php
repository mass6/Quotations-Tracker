<?php

class ItemRequestsController extends \BaseController {


    public function subscribe($events)
    {
        $events->listen('quotation.update', 'ItemRequestsController@logUpdate');
    }

    public function logUpdate($event)
    {
        Log::info('Quotation No.' . $event->id . ' has been updated. Note from Item Request Controller');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $item_requests = ItemRequest::all();
		return View::make('item_requests.index', compact('item_requests'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        // grab entities for populating drop-down lists
        $customersList = Customer::lists('name', 'id');
        $categoriesList = Category::orderBy('id')->lists('name', 'id');
        $attributesList = Attribute::lists('name', 'id');
        $usersList = User::lists('first_name', 'id');

		return View::make('item_requests.create', compact('customersList', 'categoriesList', 'attributesList', 'usersList'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $input = Input::except('attachment','hasattributes');
        if (Input::has('attributes'))
        {
            $input['attributes'] = json_encode(Input::get('attributes'));
            //return $input['attributes'];
        }
        else
        {
            $input['attributes'] = null;
            //return 'nope';
        }
        // set current logged in user as the created by id
        $input['created_by'] = Sentry::getUser()->id;

		$item_request = new ItemRequest($input);
		if (! $item_request->save())
		{
			return Redirect::back()->withInput()->withErrors($item_request->getErrors())
                ->with('flash_message', 'There were validation issues');
		}
		else
		{
            if (Input::hasFile('attachment'))
            {
                $attachment = Attachment::create(array(
                    'attachable_id'   =>  $item_request->id,
                    'attachable_type' =>  get_class($item_request),
                    'attachment'=>Input::file('attachment')));
            }
			return Redirect::route('item-requests.index')
			->with('flash_message', 'Item Request was successfully created.')
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
        $item_request = ItemRequest::find($id);

        $usersList = User::lists('first_name', 'id');

        if ( $item_request->attributes )
        {
            $attributes = json_decode($item_request->attributes);
        }
        else
        {
            $attributes = null;
        }



        return View::make('item_requests.show', compact('item_request','attributes'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

        $item_request = ItemRequest::find($id);
        $user = User::find(Sentry::getUser()->id);
        if ($item_request->createdBy != $user )
        {
            return Redirect::back()->with('flash_message', "Sorry, you may only edit Item Requests which you have created.");
        }
        // grab entities for populating drop-down lists
        $customersList = Customer::lists('name', 'id');
        $categoriesList = Category::orderBy('id')->lists('name', 'id');
        //$attributesList = Attribute::lists('name', 'id');
        $usersList = User::lists('first_name', 'id');

        if ( $item_request->attributes )
        {
            $attributes = json_decode($item_request->attributes);
        }
        else
        {
            $attributes = null;
        }

       //$attributes = array('material','type','bics');

        return View::make('item_requests.edit', compact('item_request','customersList', 'categoriesList', 'attributes', 'usersList'));

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $input = Input::except('attachment');

        //return $this->object_to_array($input['attribute']);
        if ($input['hasattributes'] && Input::has('attributes'))
        {
            $input['attributes'] = json_encode($input['attributes']);
        }
        else
        {
            $input['attributes'] = null;
        }
        unset($input['hasattributes']);

        //return $input;
		$item_request = ItemRequest::find($id);
		if (! $item_request->update($input))
		{
			return Redirect::back()->withInput()->withErrors($item_request->getErrors());
		}
		else
		{
            if (Input::hasFile('attachment'))
            {
                $attachment = Attachment::create(array(
                    'attachable_id'   =>  $id,
                    'attachable_type' =>  get_class($item_request),
                    'attachment'=>Input::file('attachment')));
            }
			return Redirect::route('item-requests.index')
			->with('flash_message', 'Item Request was successfully updated.')
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
		ItemRequest::find($id)->delete();
		return Redirect::route('item-requests.index');
	}

    public function attachQuotation($id, $quotation)
    {
        Quotation::find($quotation)->itemRequests()->attach($id);
        return Redirect::back()
            ->with('flash_message', 'Quotation successfully linked to Item Request.')
            ->with('success', true);
    }




}
