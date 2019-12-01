<?php

namespace App\Http\Controllers;

use App\Pharmacy;
use App\Traits\PharmacyNets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QuickNavigationController extends Controller
{
    use PharmacyNets;

    // Handles get requests from the quick navigation bar.
    public function quickNavigation(Request $request, Pharmacy $pharmacy)
    {
        setlocale(LC_ALL,'uk_UA.utf8');
        $counter = 0;
        $pharmacyNets = $this->pharmacyNets;
        $pharmacyNetsMerged = array_merge($pharmacyNets['anc'], $pharmacyNets['aptekar'], $pharmacyNets['vitamin'], $pharmacyNets['tas'], $pharmacyNets['pharmastor']);
        $selectionData = $request->input('net');
            switch ($selectionData){
                case 'anc':
                   $queryData = $pharmacyNets['anc'];
                   break;
                case 'aptekar':
                   $queryData = $pharmacyNets['aptekar'];
                   break; 
                case 'vitamin':
                   $queryData = $pharmacyNets['vitamin'];
                   break; 
                case 'tas':
                   $queryData = $pharmacyNets['tas'];
                   break; 
                case 'pharmastor':
                   $queryData = $pharmacyNets['pharmastor'];
                   break; 
                case ('vip_nets' || 'retail'):
                   $queryData = $pharmacyNetsMerged;
                   break;   
            }
        if (auth()->user()->name == 'Овчаренко Анатолий') {
            if ($selectionData == 'retail'){
                $pharmacy = Pharmacy::whereNotIn('legal_entity', $queryData)->get()->sortBy('legal_entity', SORT_LOCALE_STRING); 
            } else {
            $pharmacy = Pharmacy::whereIn('legal_entity', $queryData)->get()->sortBy('legal_entity', SORT_LOCALE_STRING);    
            } 
        } else {
            if ($selectionData == 'retail'){
                $pharmacy = auth()->user()->pharmacies()->whereNotIn('legal_entity', $queryData)->get()->sortBy('legal_entity', SORT_LOCALE_STRING); 
            } else {
            $pharmacy = auth()->user()->pharmacies()->whereIn('legal_entity', $queryData)->get()->sortBy('legal_entity', SORT_LOCALE_STRING);
            }
        }
        Session::put('pharmacy', $pharmacy);   
        return view('pharmacies.index', compact('pharmacy', 'counter', 'pharmacyNets'));
    }    
}
