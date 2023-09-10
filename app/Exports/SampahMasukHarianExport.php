<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SampahMasukHarianExport implements FromView
{
    protected $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('export.sampah_masuk_harian', ['items' => $this->data]);
    }
}
