<?php

class Category extends BaseModel

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
        'name'		 	=> 	'required|max:45|unique:categories',
        'description' 	=>	'required|max:150',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * Relation definition to ItemRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function itemRequests()
    {
        return $this->hasMany('ItemRequest');
    }


}



