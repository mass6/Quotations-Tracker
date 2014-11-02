<?php

use Insight\Entities\Comment;

class CommentsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
     * Stores a comment
     *
     * @param $type the model type
     * @param $id the model id
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function store($type, $id)
	{
        //Return Input::all();
        $user = Sentry::getUser()->id;
        $comment = new Comment(array(
            'user_id' => $user,
            'commentable_id'   =>  $id,
            'commentable_type' =>  $type,
            'body'  =>  Input::get('body')
        ));
        if (! $comment->save())
        {
            return Redirect::back()->withInput()->withErrors($comment->getErrors())
                ->with('comment_message', 'There were validation issues')
                ->with('success', false);
        }
        else
        {
            return Redirect::back()
                ->with('comment_message', 'Your comment was successfully created.')
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


}
