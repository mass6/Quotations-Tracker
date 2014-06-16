<?php

class Attribute extends BaseModel

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
		'name'		 	=> 	'required|max:45|unique:attributes',
		'description' 	=>	'max:150',
	];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'attributes';

    /**
     * Text friendly attribute labels
     *
     * @var array
     */
    protected static $labels =  array(
        'boolean'   => 'Yes/No',
        'textarea'  => 'Text Area',
    );


}



