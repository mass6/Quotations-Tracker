<?php

use Acme\Repositories\MyInterface;

class QuotationsController extends \BaseController {

    protected $quotation;

    public function __construct(MyInterface $quotation)
    {
        $this->quotation = $quotation;
    }

    public function subscribe($events)
    {
        $events->listen('quotation.update', 'QuotationsController@logUpdate', 10);
    }

    public function logUpdate($event)
    {
        Log::info('Quotation No.' . $event->id . ' has been updated. Note from Quotations Controller');
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        //$quotations = Quotation::all();
        $quotations = $this->quotation->getAll();
		return View::make('quotations.index', compact('quotations'));
	}


    /**
     * Show the form for creating a new resource
     *
     * @param null $item_request_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create($item_request_id = null)
	{
        $suppliers = Supplier::lists('name', 'id');
        $statuses = Quotation::statuses();
        if ($item_request_id)
        {
            //return 'create Quotation for I.R. No. : ' . $item_request;
            $item_request = ItemRequest::find($item_request_id);

            // Get required attributes from Item Request. After quotation creation,
            // the attributes will be stored in quotation model
            $attributes = json_decode($item_request->attributes);
            //$user = $item_request->assignedTo->first_name;
            return View::make('quotations.create', compact('item_request', 'attributes', 'suppliers', 'statuses'));
//            $response = array(
//                'success' => true,
//                'item_request' => $item_request->id,
//                'item_request_name' => $item_request->name,
//                'item_request_created' => $item_request->created_at->format('d-m-Y'),
//                'attributes' => $attributes,
//                'user' => $user,
//            );
        }
        else
        {
            return View::make('quotations.create', compact('suppliers', 'statuses'));
        }
//        if (! $itemRequests = ItemRequest::getAssignedRequestsList())
//        {
//            return Redirect::back()->with('flash_message', 'No item requests exist to attach a quotation to. Please create an item request first.');
//        }

//        $suppliers = Supplier::lists('name', 'id');
//        $statuses = Quotation::statuses();

    }

    public function select() {

        //check if its our form
        if ( Session::token() !== Input::get( '_token' ) ) {
            return Response::json( array(
                'msg' => 'Unauthorized attempt to create setting'
            ) );
        }

        $item_request = ItemRequest::find(Input::get( 'item_request' ));

        // Get required attributes from Item Request. After quotation creation,
        // the attributes will be stored in quotation model
        $attributes = json_decode($item_request->attributes);
        $user = $item_request->assignedTo->first_name;

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
        $input = Input::all();
        $input['created_by'] = Sentry::getUser()->id;
        if ( Input::has('valid_until') )
        {
            $input['valid_until'] = Carbon::createFromFormat('d-m-Y', $input['valid_until']);
        }

        if ( Input::has('attributes') )
        {
            $attributes = Input::get('attributes');
            // add assigned attributes to model's $rules array
            $rules = $this->addAttributesToRules(Quotation::$rules, $attributes);
            // serialize all the dynamic attribute fields into an array for persisting to DB
            $attributeValues = $this->serializeAttributesValuesToArray(Input::all());
        }
        else
        {
            $input['attributes'] = array();
            $input['attribute_values'] = array();
            $rules = Quotation::$rules;
            $attributeValues = array();
        }

        $validation = Validator::make($input, $rules);
        if ( $validation->fails() )
        {
            return Redirect::back()->withInput()->withErrors($validation)
                ->with('flash_message', 'There were validation issues')
                ->with('success', false)
                ->with('attributes', $input['attributes'])
                ->with('values', $attributeValues)
                ->with('item_request', ItemRequest::find($input['item_request']))
                ->with('create_revalidate', 'create_revalidate')
                ->with('create', 'create')
                ->with('revalidate', 'revalidate');
        }
        else
        {
            // TODO : Make create and update array instead of listing columns individually
            $quotation = Quotation::create(array(
                'item_request'          => $input['item_request'],
                'supplier_id'           => $input['supplier_id'],
                'valid_until'           => $input['valid_until'],
                'product_name'          => $input['product_name'],
                'product_code'          => $input['product_code'],
                'product_description'   => $input['product_description'],
                'attributes'            => json_encode($input['attributes']),
                'attribute_values'      => json_encode($attributeValues),
                'uom'                   => $input['uom'],
                'uom_price'             => $input['uom_price'],
                'min_qty'               => $input['min_qty'],
                'packaging'             => $input['packaging'],
                'pack_price'            => $input['pack_price'],
                'delivery_notes'        => $input['delivery_notes'],
                'notes'                 => $input['notes'],
                'status'                => $input['status'],
                'created_by'            => $input['created_by'],
            ));

            if ( Input::has('item_request'))
            {
                ItemRequest::find($input['item_request'])->quotations()->save($quotation);
            }

            if (Input::hasFile('attachment'))
            {
                $attachment = Attachment::create(array(
                    'attachable_id'   =>  $quotation->id,
                    'attachable_type' =>  get_class($quotation),
                    'attachment'=>Input::file('attachment')));
            }
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
        $quotation = Quotation::find($id);
        // create string variable from Carbon date object
        $valid_until = $quotation->valid_until->format('d-m-Y');
        // convert attributes json object to standard array object
        $attributes = json_decode($quotation->attributes);
        $attribute_values = json_decode($quotation->attribute_values);

        return View::make('quotations.show', compact('quotation', 'statuses', 'attributes', 'attribute_values', 'valid_until'))
            ->with('reload','reload');
	}


    /**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $quotation = Quotation::find($id);
        $user = User::find(Sentry::getUser()->id);
        if ($quotation->createdBy != $user && $quotation->status == 'draft')
        {
            return Redirect::back()->with('flash_message', "Sorry, you can only edit quotations drafts that are created by to you.");
        }

        // convert attributes json object to standard array object
        $attributes = json_decode($quotation->attributes);
        $values = json_decode($quotation->attribute_values);
        $item_requests = $quotation->itemRequests();

        return View::make('quotations.edit', compact('quotation','item_requests','attributes','values'));
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
        if ( $input['valid_until'] != null)
        {
            $input['valid_until'] = Carbon::createFromFormat('d-m-Y', $input['valid_until']);
        }

        $quotation = Quotation::find($id);
        //return Input::all();
        if ( Input::has('attributes') )
        {
            $attributes = Input::get('attributes');

            // add assigned attributes to model's $rules array
            $rules = $this->addAttributesToRules(Quotation::$rules, $attributes);
            // serialize all the dynamic attribute fields into an array for persisting to DB
            $attributeValues = $this->serializeAttributesValuesToArray(Input::all());
        } else{
            $input['attributes'] = array();
            $input['attribute_values'] = array();
            $rules = Quotation::$rules;
            $attributeValues = array();
        }
        unset($rules['created_by']);

        $validation = Validator::make($input, $rules);
        if ( $validation->fails() )
        {
            //return "failed";
            return Redirect::back()->withInput()->withErrors($validation)
                ->with('flash_message', 'There were validation issues')
                ->with('success', false)
                ->with('attributes', $input['attributes'])
                ->with('values', $attributeValues)
                ->with('item_request', ItemRequest::find($input['item_request']))
                ->with('revalidate', 'revalidate');
        }
        else{
            // TODO : change to defined array
            $quotation->update(array(
                'item_request'          => $input['item_request'],
                'supplier_id'           => $input['supplier_id'],
                'valid_until'           => $input['valid_until'],
                'product_name'          => $input['product_name'],
                'product_code'          => $input['product_code'],
                'product_description'   => $input['product_description'],
                'attributes'            => json_encode($input['attributes']),
                'attribute_values'      => json_encode($attributeValues),
                'uom'                   => $input['uom'],
                'uom_price'             => $input['uom_price'],
                'min_qty'               => $input['min_qty'],
                'packaging'             => $input['packaging'],
                'pack_price'            => $input['pack_price'],
                'delivery_notes'        => $input['delivery_notes'],
                'notes'                 => $input['notes'],
                'status'                => $input['status'],
            ));
            Event::fire('quotation.update', ['quotation' => $quotation]); // trigger test event
            if (Input::hasFile('attachment'))
            {
                $attachment = Attachment::create(array(
                    'attachable_id'   =>  $quotation->id,
                    'attachable_type' =>  get_class($quotation),
                    'attachment'=>Input::file('attachment')));
            }
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
        Quotation::find($id)->delete();
        return Redirect::route('quotations.index');

        // TODO : Implement soft deletes
	}

    public function attachRequest($id)
    {
        if ( Input::has('item-request-attach'))
        {
            $item_request = ItemRequest::find(Input::get('item-request-attach'));
            if ( ! $item_request->quotations->contains($id))
            {
                $item_request->quotations()->attach($id);
                return Redirect::back()
                    ->with('flash_message', 'Item Request successfully linked to Item Request.')
                    ->with('success', true);
            }
            else
            {
                return Redirect::back()
                    ->with('flash_message', 'Quotation is already linked to Item Request.')
                    ->with('success', false);
            }
            // TODO : Filter dropdown list to only include item requests that are not currently linked to quotation
        }
    }

    public function detachRequest($id, $item_request)
    {
        ItemRequest::find($item_request)->quotations()->detach($id);
        return Redirect::back()
            ->with('flash_message', 'Unlinked Item Request #' . $item_request . ' from Quotation')
            ->with('success', true);
    }

    /**
     * Add the dynamic form attributes to the existing
     * model's validation rules array
     *
     * @param $rules
     * @param $attributes
     * @return null
     */
    protected function addAttributesToRules($rules, $attributes)
    {
        if ( count($attributes) )
        {
            $i = 0; //counter
            foreach ($attributes as $attribute)
            {
                $rules[str_replace(' ','_',$attribute)] = 'required';
                $i++;
            }
            return $rules;
        }
        return null;
    }


    /**
     * Looks for the attributes[] key present in the input array,
     * and then serializes the values with the same names as
     * the indexes in attributes[] into a new array.
     *
     * @param $input
     * @return array|null
     */
    protected function serializeAttributesValuesToArray($input)
    {
        if ( array_key_exists('attributes',$input) )
        {
            $attributes = $input['attributes'];
            $attributeValues = array();

            foreach ($attributes as $attribute)
            {
                $attributeValues[] = $input[str_replace(' ','_',$attribute)];
            }
            return $attributeValues;
        }
        return null;
    }


}
