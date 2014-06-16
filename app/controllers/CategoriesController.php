<?php

class CategoriesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $categories = Category::all();
		return View::make('categories.index', compact('categories'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('categories.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$category = new Category(Input::all());
		if (! $category->save())
		{
			return Redirect::back()->withInput()->withErrors($category->getErrors());
		}
		else
		{
			return Redirect::route('categories.index')
			->with('flash_message', 'Category was successfully created.')
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
		$category = Category::find($id);
		return View::make('categories.edit', compact('category'));
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
		$category = Category::find($id);
		if (! $category->update($input))
		{
			return Redirect::back()->withInput()->withErrors($category->getErrors());
		}
		else
		{
			return Redirect::route('categories.index')
			->with('flash_message', 'Category was successfully updated.')
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
		Category::find($id)->delete();
		return Redirect::route('categories.index');
	}


}
