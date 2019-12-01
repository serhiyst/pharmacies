<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class PharmacyExport implements FromView, ShouldAutoSize
{
	
    public function view(): View
    {
    	$counter = 0;
        return view('export.to-excel', [
            'pharmacy' => Session::get('pharmacy'), 'counter' => $counter
        ]);
    }
}
