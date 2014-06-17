<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 6/16/14
 * Time: 3:47 PM
 */

class Quotation extends \BaseModel
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


    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'quotations';

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
     * Relation definition to Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('Category');
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