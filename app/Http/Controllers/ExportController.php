<?php

namespace App\Http\Controllers;

use App\Exports\PharmacyExport;
use App\Pharmacy;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
	
    public function export(Pharmacy $pharmacy) 
    {
        return Excel::download(new PharmacyExport($pharmacy), 'pharmacy.xlsx');
    }
}
