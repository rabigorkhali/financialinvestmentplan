<?php

namespace App\Exports;

use App\Model\Language;
use App\Model\Locale;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ErrorLogExport implements FromView, ShouldAutoSize,ShouldQueue
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('system.exports.errorLogs', [
            'items' => $this->data,
        ]);
    }
}
