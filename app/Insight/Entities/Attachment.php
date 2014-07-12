<?php namespace Insight\Entities;
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 6/16/14
 * Time: 3:47 PM
 */

use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Attachment extends BaseModel implements StaplerableInterface
{
    use EloquentTrait;

    public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('attachment', [

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

    ];

    public function attachable()
    {
        return $this->morphTo();
    }

}