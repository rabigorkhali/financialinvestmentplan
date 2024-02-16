<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class testExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function collection()
    {
        // Replace this with your actual data retrieval logic
        return collect([
            ['Name', 'Email'],
            ['John Doe', 'john@example.com'],
            ['Jane Doe', 'jane@example.com'],
        ]);
    }
}
