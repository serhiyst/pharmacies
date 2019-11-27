<?php

namespace App\Http\Controllers;

use App\Mail\PharmacyUpdated;
use App\Mail\PharmacyCreated;
use App\Mail\PharmacyDeleted;
use App\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class PharmacyController extends Controller
{
    public $anc = ['Аптека АНЦ ТОВ',
                    'Аптека Низьких Цін К ТОВ',
                    'Аптека низьких цін ТМ ТОВ', 
                    'Аптека низьких цін плюс ТОВ', 
                    'Благодія ТОВ',];
    public $aptekar = ['Аптекарь ТОВ м.Київ@@@',
                    'Віталюкс ТОВ г.Киев',];
    public $vitamin = ['Вітамін-1 ТОВ',
                    'Вітамінка ТОВ',
                    'Вітамін-Центр ТОВ', 
                    'СМАРТ-ФАРМАЦІЯ ТОВ',];
    public $tas = ['ТАС - Фарма ТОВ',];
    public $pharmastor = ['Фармастор м.Київ'];

    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pharmacy $pharmacy)
    {
        setlocale(LC_ALL,'uk_UA.utf8');
        $counter = 0;
        $anc = $this->anc;
        $aptekar = $this->aptekar;
        $vitamin = $this->vitamin;
        $tas = $this->tas;
        $pharmastor = $this->pharmastor;
        if (auth()->user()->name == 'Овчаренко Анатолий') {
            $pharmacy = Pharmacy::all()->sortBy('legal_entity', SORT_LOCALE_STRING);    
        } else {
            $pharmacy = auth()->user()->pharmacies()->get()->sortBy('legal_entity', SORT_LOCALE_STRING);
        }   
        return view('pharmacies.index', compact('pharmacy', 'counter', 'anc', 'aptekar', 'vitamin', 'tas', 'pharmastor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pharmacies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pharmacy = Pharmacy::create($request->all() + ['sales_rep' => auth()->user()->name]);
        Mail::to('admin@example.com')->queue(new PharmacyCreated($pharmacy));
        return redirect('/pharmacies')  ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function show(Pharmacy $pharmacy)
    {
        $this->authorize('update', $pharmacy);
        return view('pharmacies.show', compact('pharmacy'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function edit(Pharmacy $pharmacy)
    {
        $this->authorize('update', $pharmacy);
        return view('pharmacies.edit', compact('pharmacy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pharmacy $pharmacy)
    {
        $this->authorize('update', $pharmacy);
        $pharmacy->update($request->except('inform'));
        $changes = $pharmacy->getChanges();
        if ($request->input('inform') == 'checked') {
            Mail::to('admin@example.com')->send(new PharmacyUpdated($pharmacy, $changes));
        }
        return redirect('/pharmacies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pharmacy $pharmacy)
    {
        $this->authorize('update', $pharmacy);
        Mail::to('admin@example.com')->send(new PharmacyDeleted($pharmacy));
        $pharmacy = $pharmacy->delete();
        return redirect('/pharmacies');
    }

    // Quick search using the search bar at the top.
    public function search(Request $request, Pharmacy $pharmacy)
    {
        $search_data = $request->input('search');
        $counter = 0;
        $anc = $this->anc;
        $aptekar = $this->aptekar;
        $vitamin = $this->vitamin;
        $tas = $this->tas;
        $pharmastor = $this->pharmastor;
        if (auth()->user()->name == 'Овчаренко Анатолий') {
            $pharmacy = Pharmacy::where('legal_entity', 'like', "%{$search_data}%")->get()->sortBy('legal_entity');} else {
        $pharmacy = auth()->user()->pharmacies()->where('legal_entity', 'like', "%{$search_data}%")->get()->sortBy('legal_entity');
        }
        return view('pharmacies.index', compact('pharmacy', 'counter', 'anc', 'aptekar', 'vitamin', 'tas', 'pharmastor', 'search_data'));
    }

    // Show the form for creating a new custom search.
    public function customSearchForm()
    {
        return view('pharmacies.custom-search');
    }

    // Handles a custom search request.
    public function customSearch(Request $request, Pharmacy $pharmacy)
    {
        $search_data = $request->all();
        $counter = 0;
        $anc = $this->anc;
        $aptekar = $this->aptekar;
        $vitamin = $this->vitamin;
        $tas = $this->tas;
        $pharmastor = $this->pharmastor;
        $pharmacy = Pharmacy::when(auth()->user()->name == 'Овчаренко Анатолий', function ($query) use ($pharmacy){
                                                    return $pharmacy;})
                    ->when(auth()->user()->name != 'Овчаренко Анатолий', function ($query) use ($pharmacy){
                                                    return auth()->user()->pharmacies();})
                    ->when(!empty($request->input('legal_entity')), function ($query) use ($request){
                                                    return $query->where('legal_entity', 'like', "%{$request->input('legal_entity')}%");})
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
        return view('pharmacies.index', compact('pharmacy', 'counter', 'anc', 'aptekar', 'vitamin', 'tas', 'pharmastor', 'search_data'));
    }

    // Handles get requests from the quick navigation bar.
    public function selection(Request $request, Pharmacy $pharmacy)
    {
        setlocale(LC_ALL,'uk_UA.utf8');
        $counter = 0;
        $anc = $this->anc;
        $aptekar = $this->aptekar;
        $vitamin = $this->vitamin;
        $tas = $this->tas;
        $pharmastor = $this->pharmastor;
        $vip_nets = array_merge($anc, $aptekar, $vitamin, $tas, $pharmastor);
        $selection_data = $request->input('net');
            switch ($selection_data){
                case 'anc':
                   $query_data = $anc;
                   break;
                case 'aptekar':
                   $query_data = $aptekar;
                   break; 
                case 'vitamin':
                   $query_data = $vitamin;
                   break; 
                case 'tas':
                   $query_data = $tas;
                   break; 
                case 'pharmastor':
                   $query_data = $pharmastor;
                   break; 
                case 'vip_nets':
                   $query_data = $vip_nets;
                   break; 
                case 'retail':
                   $query_data = $vip_nets;
                   break;  
            }
        if (auth()->user()->name == 'Овчаренко Анатолий') {
            if ($selection_data == 'retail'){
                $pharmacy = Pharmacy::whereNotIn('legal_entity', $query_data)->get()->sortBy('legal_entity', SORT_LOCALE_STRING); 
            } else {
            $pharmacy = Pharmacy::wherein('legal_entity',$query_data)->get()->sortBy('legal_entity', SORT_LOCALE_STRING);    
            } 
        } else {
            if ($selection_data == 'retail'){
                $pharmacy = auth()->user()->pharmacies()->whereNotIn('legal_entity',$query_data)->get()->sortBy('legal_entity', SORT_LOCALE_STRING); 
            } else {
            $pharmacy = auth()->user()->pharmacies()->wherein('legal_entity',$query_data)->get()->sortBy('legal_entity', SORT_LOCALE_STRING);
            }
        }   
        return view('pharmacies.index', compact('pharmacy', 'counter', 'anc', 'aptekar', 'vitamin', 'tas', 'pharmastor', 'vip_nets', 'query_data'));
    }
}
