<?php

class UserItemRequestsController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @param $userId
     * @return string
     */
    public function index($userId = null)
	{
		if ( Sentry::getUser() == Sentry::findUserById($userId))
        {
            $heading = 'My Assigned Item Requests';
        }
        else
        {
            $heading = 'Item Requests assigned to ' . User::find($userId)->first_name;
        }
        $item_requests = User::findOrFail($userId)->assignedRequests;
        $filtered = true;

        return View::make('item_requests.index', compact('item_requests', 'heading', 'filtered'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
	 * @param  string  $user
	 * @param  int  $id
	 * @return Response
	 */
	public function show($user, $id)
	{
        //return $item_request = ItemRequest::where('assigned_to', $user)->get();
        return $requests = ItemRequest::with('createdBy', 'assignedTo')->find($id);
        //return $user = ItemRequest::find($id)->assignedTo;
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

    public function getMyRequests()
    {
        $user = User::find(Sentry::getUser()->id);
        $heading = 'My Assigned Item Requests';

        $item_requests = $user->createdRequests;
        $filtered = true;

        return View::make('item_requests.index', compact('item_requests', 'heading', 'filtered'));
    }


}
