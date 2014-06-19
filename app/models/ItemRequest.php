<?php

class ItemRequest extends BaseModel

{
    /**
     * Defined attributes that may not be mass-assigned
     *
     * @var array
     */
	protected $guarded = ['id'];

    /**
     * Attribute validation rules
     *
     * @var array
     */
	public static $rules = [
		'customer_id'       =>  'required',
        'reference'         =>  'max:45',
        'status'			=>	'required|in:draft,assigned,completed,cancelled',
        'name'		        => 	'required|max:255',
        'description' 		=>	'max:250',
        'category_id'       =>  'required|integer|exists:categories,id',
        'estimated_volume'  =>  'max:250',
        'current_uom'       =>  'max:45',
        'current_price'     =>  'max:45',
        'created_by'        =>  'required|integer|exists:users,id',
        'assigned_to'       =>  'required|integer|exists:users,id',

	];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'item_requests';

    /**
     * Text friendly attribute labels
     *
     * @var array
     */
    protected static $labels =  array(
        'assigned'   => 'Assigned',
    );

    /**
     * Relation definition to Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('Customer');
    }

    /**
     * Relation definition to Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('Category');
    }

    /**
     * Relation definition to Quotation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quotations()
    {
        return $this->hasMany('Quotation', 'item_request');
    }

    /**
     * Relation definition to User (assignedTo)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assignedTo()
    {
        return $this->belongsTo('User', 'assigned_to');
    }

    /**
     * Relation definition to User (createdBy)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo('User', 'created_by');
    }

    /**
     * Item request statuses array for populating drop down lists
     *
     * @return array
     */
    public static function statuses()
    {
        return array(
            'draft'     =>  'Draft',
            'assigned'  =>  'Assigned',
            'completed' =>  'Completed',
            'cancelled' =>  'Cancelled'
        );
    }


}



