<?php

namespace App\Http\Controllers;

use App\Pharmacy;
use Illuminate\Http\Request;


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
        return redirect('/pharmacies');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function show(Pharmacy $pharmacy)
    {
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
        $pharmacy->update($request->all());
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
        $pharmacy->delete();
        return redirect('/pharmacies');
    }


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
            if ($selection_data == 'anc'){
                $query_data = $anc;
            } elseif ($selection_data == 'aptekar') {
                $query_data = $aptekar;
            } elseif ($selection_data == 'vitamin') {
                $query_data = $vitamin;
            } elseif ($selection_data == 'tas') {
                $query_data = $tas;
            } elseif ($selection_data == 'pharmastor') {
                $query_data = $pharmastor;
            } elseif ($selection_data == 'vip_nets') {
                $query_data = $vip_nets;
            } elseif ($selection_data == 'retail') {
                $query_data = $vip_nets;
            }
        if (auth()->user()->name == 'Овчаренко Анатолий') {
            if ($selection_data == 'retail'){
                $pharmacy = Pharmacy::all()->diff(Pharmacy::wherein('legal_entity',$query_data)->get())->sortBy('legal_entity', SORT_LOCALE_STRING); 
            } else {
            $pharmacy = Pharmacy::wherein('legal_entity',$query_data)->get()->sortBy('legal_entity', SORT_LOCALE_STRING);    
            } 
        } else {
            $pharmacy = auth()->user()->pharmacies()->get()->sortBy('legal_entity', SORT_LOCALE_STRING);
        }   
        return view('pharmacies.index', compact('pharmacy', 'counter', 'anc', 'aptekar', 'vitamin', 'tas', 'pharmastor', 'vip_nets', 'query_data'));
    }
}
