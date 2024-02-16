<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
class TranslationImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function __construct()
    {
//
    }

    public function collection(Collection $rows)
    {
        return $rows;
    }
}
