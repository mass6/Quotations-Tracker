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
		return View::make('quotations.index', array('title' => 'quotations'));
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

        $item_request_id = Input::get( 'item_request' );
        $user = ItemRequest::find($item_request_id)->assignedTo->first_name;
        //.....
        //validate data
        //and then store it in DB
        //.....

        $response = array(
            'status' => 'new',
            'success' => true,
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
		//
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
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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


}
