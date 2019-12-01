<?php

namespace App\Http\Controllers;

use App\Pharmacy;
use App\Traits\PharmacyNets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SearchController extends Controller
{
	use PharmacyNets;

	public function __construct()
    {
      $this->middleware('auth');
    }

    // Quick search using the search bar at the top.
    public function search(Request $request, Pharmacy $pharmacy)
    {
        $searchData = $request->input('search');
        $counter = 0;
        $pharmacyNets = $this->pharmacyNets;
        if (auth()->user()->name == 'Овчаренко Анатолий') {
            $pharmacy = Pharmacy::where('legal_entity', 'like', "%{$searchData}%")->get()->sortBy('legal_entity');} else {
        $pharmacy = auth()->user()->pharmacies()->where('legal_entity', 'like', "%{$searchData}%")->get()->sortBy('legal_entity');
        }
        Session::put('pharmacy', $pharmacy);
        return view('pharmacies.index', compact('pharmacy', 'counter', 'pharmacyNets', 'searchData'));
    }

    // Show the form for creating a new custom search.
    public function customSearchForm()
    {
        return view('pharmacies.custom-search');
    }

    // Handles a custom search request.
    public function customSearch(Request $request, Pharmacy $pharmacy)
    {     
        $counter = 0;
        $pharmacyNets = $this->pharmacyNets;
        $pharmacyNetsMerged = array_merge($pharmacyNets['anc'], $pharmacyNets['aptekar'], $pharmacyNets['vitamin'], $pharmacyNets['tas'], $pharmacyNets['pharmastor']);
        $pharmacy = Pharmacy::when(auth()->user()->name == 'Овчаренко Анатолий', function ($query) use ($pharmacy){
                        return $pharmacy;})
                    ->when(auth()->user()->name != 'Овчаренко Анатолий', function ($query) use ($pharmacy){
                        return auth()->user()->pharmacies();})
                    ->when(!empty($request->input('legal_entity')), function ($query) use ($request, $pharmacyNets, $pharmacyNetsMerged) {
                        if ($request->input('legal_entity') == 'Сеть АНЦ') {
                            return $query->whereIn('legal_entity', $pharmacyNets['anc']);
                        } elseif ($request->input('legal_entity') == 'Сеть Аптекарь') {
                            return $query->whereIn('legal_entity', $pharmacyNets['aptekar']);
                        } elseif ($request->input('legal_entity') == 'Сеть Витамин') {
                            return $query->whereIn('legal_entity', $pharmacyNets['vitamin']);
                        } elseif ($request->input('legal_entity') == 'Вип') {
                            return $query->whereIn('legal_entity', $pharmacyNetsMerged);
                        } elseif ($request->input('legal_entity') == 'Розница') {
                            return $query->whereNotIn('legal_entity', $pharmacyNetsMerged);
                        } else {
                            return $query->where('legal_entity', 'like', "%{$request->input('legal_entity')}%");}
                        })
                    ->when(!empty($request->input('address')), function ($query) use ($request){
                        return $query->where('address', 'like', "%{$request->input('address')}%");})
                    ->when(!empty($request->input('city')), function ($query) use ($request){
                        return $query->where('city', 'like', "%{$request->input('city')}%");})
                    ->when(!empty($request->input('district')), function ($query) use ($request){
                        return $query->where('district', 'like', "%{$request->input('district')}%");})
                    ->when(!empty($request->input('sales_rep')), function ($query) use ($request){
                        return $query->where('sales_rep', 'like', "%{$request->input('sales_rep')}%");})
                    ->when(!empty($request->input('category')), function ($query) use ($request){
                        return $query->where('category', 'like', "%{$request->input('category')}%");})
                    ->when(!empty($request->input('day_of_order')), function ($query) use ($request){
                        return $query->where('day_of_order', 'like', "%{$request->input('day_of_order')}%");})
                    ->when(!empty($request->input('day_of_delivery')), function ($query) use ($request){
                        return $query->where('day_of_delivery', 'like', "%{$request->input('day_of_delivery')}%");})
                    ->when(!empty($request->input('equipment')), function ($query) use ($request){
                        return $query->where('equipment', 'like', "%{$request->input('equipment')}%");})
                    ->when(!empty($request->input('sales_rep')), function ($query) use ($request){
                        return $query->where('sales_rep', 'like', "%{$request->input('sales_rep')}%");})->get()->sortBy('legal_entity');

        Session::put('pharmacy', $pharmacy);
        return view('pharmacies.index', compact('pharmacy', 'counter', 'pharmacyNets'));
    }
}
