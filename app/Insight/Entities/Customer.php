<?php namespace Insight\Entities;
use Insight\Entities\ItemRequest;

class Customer extends BaseModel

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
        'name'		 	=> 	'required|max:255|unique:customers',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * Text friendly attribute labels
     *
     * @var array
     */
    protected static $labels =  array(

    );

    /**
     * Relation definition to ItemRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function itemRequests()
    {
        return $this->hasMany('Insight\Entities\ItemRequest');
    }


}



