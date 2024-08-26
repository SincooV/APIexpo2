<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ConcatenatedFields implements Rule
{
    protected $field1Value;
    protected $field2Value;

    public function __construct($field1Value, $field2Value)
    {
        $this->field1Value = $field1Value;
        $this->field2Value = $field2Value;
    }

    public function passes($attribute, $value)
    {
        // Concatenate field1 and field2 values and compare with field3
        $concatenated = $this->field1Value . $this->field2Value;
        return $value === $concatenated;
    }

    public function message()
    {
        return 'The :attribute must be the concatenation of the provided field1 and field2 values.';
    }
}
