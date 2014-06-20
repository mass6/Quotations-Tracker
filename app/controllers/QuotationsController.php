<?php

class QuotationsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $quotations = Quotation::all();
		return View::make('quotations.index', compact('quotations'));
	}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
	{
        if (! $itemRequests = $this->getAssignedRequestsList())
        {
            return Redirect::back()->with('flash_message', 'No item requests exist to attach a quotation to. Please create an item request first.');
        }

        $suppliers = Supplier::lists('name', 'id');
        $statuses = Quotation::statuses();
//        return $itemRequests; // = json_encode($itemRequests, JSON_FORCE_OBJECT);
//        //return ItemRequest::lists('name', 'id');
        return View::make('quotations.create', compact('itemRequests','suppliers', 'statuses'));
	}

    public function select() {

        //check if its our form
        if ( Session::token() !== Input::get( '_token' ) ) {
            return Response::json( array(
                'msg' => 'Unauthorized attempt to create setting'
            ) );
        }

        $item_request = ItemRequest::find(Input::get( 'item_request' ));
        //$attributes = json_encode($this->jsonObjectsToArray($item_request->attributes));
        $attributes = $this->jsonObjectsToArray($item_request->attributes);
        $user = $item_request->assignedTo->first_name;

        //.....
        //validate data
        //and then store it in DB
        //.....

        $response = array(
            'success' => true,
            'item_request' => $item_request->id,
            'item_request_name' => $item_request->name,
            'item_request_created' => $item_request->created_at->format('d-m-Y'),
            'attributes' => $attributes,
            'user' => $user,
        );

        return Response::json( $response );
    }


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
//        return Input::all();

        $input = Input::all();
        $input['attributes'] = json_encode($input['attributes']);

        // set current logged in user as the created by id
        $input['created_by'] = Sentry::getUser()->id;

        $quotation = new Quotation($input);
        if (! $quotation->save())
        {
            return Redirect::back()->withInput()->withErrors($quotation->getErrors())
                ->with('flash_message', 'There were validation issues')
                ->with('success', false)
                ->with('item_request', $input['item_request'])
                ->with('revalidate', 'revalidate');
        }
        else
        {
            return Redirect::route('quotations.index')
                ->with('flash_message', 'Quotation was successfully created.')
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
//        $item_request = ItemRequest::find(1);
//        return $attributes = $this->jsonObjectsToArray($item_request->attributes);
//        // delete above

        $quotation = Quotation::find($id);
        $user = User::find(Sentry::getUser()->id);
        if ($quotation->createdBy != $user && $quotation->status == 'draft')
        {
            return Redirect::back()->with('flash_message', "Sorry, you can only edit quotations drafts that are created by to you.");
        }
        // reformat attributes from json to standard array
        //return json_decode($quotation->attributes);
//        $valid_until = new DateTime($quotation->valid_until);
//        $quotation->valid_until = $valid_until->format('Y-m-d');
//        $quotation->valid_until = $quotation->valid_until->format('d-m-Y');
        $valid_until = $quotation->valid_until->format('d-m-Y');
        //return $quotation;
        $attributes = $this->jsonObjectsToArray($quotation->attributes);

        // grab entities for populating drop-down lists
        $suppliers = Supplier::lists('name', 'id');
        $statuses = Quotation::statuses();
        //$attributes = json_encode(array(array("material","metal"),array("color","grey")));
        return View::make('quotations.edit', compact('quotation','suppliers', 'statuses', 'attributes', 'valid_until'))
            ->with('reload','reload');
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

//        $dinput = Input::get('valid_until');
//        $date = new DateTime('2000-01-01');
//		return $date->format('Y-m-d');

        $input = Input::all();
        $input['valid_until'] = new DateTime($input['valid_until']);
        $input['attributes'] = json_encode($input['attributes']);

        $quotation = Quotation::find($id);
        if (! $quotation->update($input))
        {
            return Redirect::back()->withInput()->withErrors($quotation->getErrors());
        }
        else
        {
            return Redirect::route('quotations.index')
                ->with('flash_message', 'Quotation was successfully updated.')
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
		//
	}

    protected function getAssignedRequestsList()
    {
        $values = ItemRequest::where('status', 'assigned')->select('name', 'id')->get();

        if($values)
        {
            $requestslist = array();
            foreach ($values as $val)
            {
                $requestslist[$val['id']] = $val['name'];
            }
            return $requestslist;
        }
        return false;

    }

    protected function setAttributesArray($attArray)
    {
        if(isset($attArray))
        {
            // final array to be returned
            $attributes = array();

            foreach ($attArray as $attribute)
            {
                //$attObj = Attribute::find($attribute[0]);

                $array = array();
                // set ID
                $array[] = ($attribute[0]);

                // set required/optional
                if(isset($attribute[1])){
                    $array[] = $attribute[1];
                } else {
                    $array[] = "optional";
                }

                // set Name
                $array[] = $attObj->name;

                // set type
                $array[] = $attObj->type;

                // set values
                if ($attObj->type == "select")
                {
                    $array[] = json_decode($attObj->values);
                } else
                    $array[] = null;

                // add array object as index in master array
                $attributes[$counter] = $array;
                $counter++;
            }
            return $attributes;
        }
        else
            return false;
    }

    protected function jsonObjectsToArray($jsonArray)
    {
        if(isset($jsonArray))
        {
            $jsonArray = json_decode($jsonArray);

            // final array to be returned
            $attributes = array();

            foreach ($jsonArray as $attribute)
            {
                // if only 1 index, add second blank index
                if ( ! is_object($attribute)  ) {
                    $attribute = array($attribute => "");
                }

                foreach($attribute as $key => $val)
                {
                    $attributes[] = array($key, $val);
                }

            }
            return json_encode($attributes);
        }
        else
            return false;
    }

}
