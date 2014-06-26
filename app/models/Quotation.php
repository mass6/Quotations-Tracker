<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 6/16/14
 * Time: 3:47 PM
 */


class Quotation extends BaseModel
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
        'item_request'          =>  'required|integer|exists:item_requests,id',
        'product_name'          =>  'required',
        'product_code'	        =>	'max:100',
        'supplier_id'		    => 	'required|integer|exists:suppliers,id',
        'valid_until'           =>  'required|date',
        'product_description'   =>  'max:1000',
        'uom'                   =>  'required|max:250',
        'uom_price'             =>  'required',
        'packaging'             =>  'max:250',
        'pack_price'            =>  'max:250',
        'status'                =>  'required',
        'created_by'            =>  'required|integer|exists:users,id',
    ];
    // TODO : consider deleting created_by validation rule and placing in store() method.

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'quotations';

    /**
     * Array of dates that shall be treated as Carbon objects
     *
     * @var array
     */
    protected $dates = array('valid_until');

    /**
     * Text friendly attribute labels
     *
     * @var array
     */
    protected static $labels =  array(

    );

    public static function  setRules()
    {
        static::$rules = static::$validationRules;
    }



    /**
     * Relation definition to Supplier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo('supplier');
    }

    /**
     * Relation definition to Item Requests
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function itemRequests()
    {
        return $this->belongsToMany('ItemRequest');
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
     * Relation definition to Attachment
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function attachments()
    {
        return $this->morphMany('Attachment', 'attachable');
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
            'submitted' =>  'Submitted',
            'valid'     =>  'Valid',
            'expired'   =>  'Expired'
        );
    }
} 