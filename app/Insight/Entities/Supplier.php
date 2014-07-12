<?php namespace Insight\Entities;

class Supplier extends BaseModel

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
        'name'		 	=> 	'required|max:255|unique:suppliers',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'suppliers';

    /**
     * Text friendly attribute labels
     *
     * @var array
     */
    protected static $labels =  array(

    );

    /**
     * Relation definition to Quotations
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quotations()
    {
        return $this->hasMany('Insight\Entities\quotations');
    }


}



