<?php namespace Insight\Entities;

use Insight\Entities;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Profile extends BaseModel implements StaplerableInterface
{

    use EloquentTrait;

    public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('avatar', [
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
        'bio'		 	=> 	'max:1000',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profiles';

    public function user()
    {
        return $this->belongsTo('Insight\Entities\User');
    }
}