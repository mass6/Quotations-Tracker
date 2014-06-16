<?php
/**
 * BaseModel
 * Used as parent model for extending all other models
 * for ease of validation
 */

class BaseModel extends Eloquent
{
	
	protected $errors;

	public static function boot()
	{
		parent::boot();

		static::saving(function($model)
		{
			return $model->validate();
		});
	}


	public function validate($id = null)
	{

        // if request is an update, ignore the current id for unique testing
        if (Request::isMethod('put'))
        {
            $rules = $this->ignoreIdRule();
            static::$rules = $rules;
        }
        $validation = Validator::make($this->getAttributes(), static::$rules);

        if ($validation->fails())
		{
			$this->errors = $validation->messages();
			
			return false;
		}

		return true;

	}

	public function getErrors()
	{
		return $this->errors;
	}

    /**
     * Returns the text friendly labels of attribute passed to the function.
     * Array of attribute labels are set in the $labels attribute of the
     * actual model implementations that extend this class
     * @param $attribute
     * @return string
     */
    public function label($attribute)
    {
        if (array_key_exists($attribute,static::$labels))
        {
            return static::$labels[$attribute];
        }
        return ucfirst($attribute);
    }

    /**
     * @return mixed
     * Used for altering the $rules attribute to ignore the
     * current id on update requests that enforce a unique value
     */
    protected function ignoreIdRule()
    {
        $rules = static::$rules;
        if (array_key_exists( 'id' , $this->attributes)) {
            foreach ( $rules as $field => &$rls ) {
                if (is_string($rls)) {
                    $rlsreplace = '';
                    $rlsarray =  explode('|', $rls);
                    foreach ($rlsarray as $onerl) {
                        if (strpos($onerl, ':') !== false) {
                            list($rule, $parameter) = explode(':', $onerl, 2);
                            $parameters = str_getcsv($parameter);
                            // if rule is 'unique' and table is same as field table being validated  and ignore parameter is not already set
                            if ($rule == 'unique' && (count  ($parameters) == 2 || count ($parameters) == 1 ) &&  $parameters[0] == $this->getTable()) {
                                if (count ($parameters) == 1)
                                    $onerl .= ',' . $field . ',' . $this->attributes['id'];
                                else
                                    $onerl .= ',' . $this->attributes['id'];
                            }
                        }
                        if ($rlsreplace != '')
                            $rlsreplace .= '|';
                        $rlsreplace .= $onerl;
                    }
                    $rls = $rlsreplace;
                }
            }
        }
        return $rules;
    }
}