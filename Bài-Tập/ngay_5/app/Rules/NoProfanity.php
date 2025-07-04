<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoProfanity implements Rule
{
    protected $blacklist = ['tuc1', 'tuc2', 'tuc3'];
    public function passes($attribute, $value)
    {
        foreach ($this->blacklist as $badword) {
            if (stripos($value, $badword) !== false) {
                return false;
            }
        }
        return true;
    }
    public function message()
    {
        return 'Trường :attribute chứa từ ngữ không phù hợp.';
    }
}
