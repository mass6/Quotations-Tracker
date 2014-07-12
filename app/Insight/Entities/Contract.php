<?php namespace Insight\Entities;

use \Eloquent;

class Contract extends Eloquent

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
        'web_id'		 	=> 	'required|max:255',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contracts';




}



