<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PengolahanKomposBulananExport implements FromView
{
    protected $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('export.pengolahan_kompos_bulanan', ['items' => $this->data]);
    }
}
