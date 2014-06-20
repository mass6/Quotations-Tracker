<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 6/16/14
 * Time: 3:47 PM
 */

use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Quotation extends BaseModel implements StaplerableInterface
{
    use EloquentTrait;

    public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('attachment', [
            'styles' => [
                'medium' => '300x300',
                'thumb' => '100x100'
            ]
        ]);

        parent::__construct($attributes);
    }

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
        'product_description'   =>  'max:1000',
        'uom'                   =>  'required|max:250',
        'uom_price'             =>  'required',
        'packaging'             =>  'max:250',
        'pack_price'            =>  'max:250',
        'status'                =>  'required',
        'created_by'            =>  'required|integer|exists:users,id',

    ];

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
    public function itemRequest()
    {
        return $this->belongsTo('ItemRequest', 'item_request');
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
            'completed' =>  'Completed',
            'cancelled' =>  'Cancelled',
            'expired'   =>  'Expired'
        );
    }
} 