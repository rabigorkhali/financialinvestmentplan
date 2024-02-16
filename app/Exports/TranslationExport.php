<?php

namespace App\Exports;

use App\Model\Language;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TranslationExport implements FromView, ShouldAutoSize
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
        return view('system.exports.translations', [
            'translations' => $this->data,
            'languages' => Language::get(),
        ]);
    }
}
