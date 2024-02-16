<?php

namespace App\Rules\system;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class UniqueCaseSenstiveValidation implements ValidationRule
{
    protected $table;
    protected $column;
    protected $ignoreId;

    public function __construct($table, $column, $ignoreId = null)
    {
        $this->table = $table;
        $this->column = $column;
        $this->ignoreId = $ignoreId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = DB::table($this->table)
            ->where("{$this->column}", strtolower($value));

        if ($this->ignoreId !== null) {
            $query->where('id', '<>', $this->ignoreId);
        }

        if ($query->exists()) {
            $fail('The :attribute has already been taken.');
        }
    }

}
