<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatePharmacy;
use App\Mail\PharmacyCreated;
use App\Mail\PharmacyDeleted;
use App\Mail\PharmacyUpdated;
use App\Pharmacy;
use App\Traits\PharmacyNets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class PharmacyController extends Controller
{
    use PharmacyNets;

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
        $pharmacyNets = $this->pharmacyNets;
        if (auth()->user()->name == 'Овчаренко Анатолий') {
            $pharmacy = Pharmacy::all()->sortBy('legal_entity', SORT_LOCALE_STRING);    
        } else {
            $pharmacy = auth()->user()->pharmacies()->get()->sortBy('legal_entity', SORT_LOCALE_STRING);
        } 
        Session::put('pharmacy', $pharmacy);
        return view('pharmacies.index', compact('pharmacy', 'counter', 'pharmacyNets'));
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
    public function store(ValidatePharmacy $request)
    {
        $pharmacy = Pharmacy::create($request->all());
        Mail::to('admin@example.com')->queue(new PharmacyCreated($pharmacy));
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
    public function update(ValidatePharmacy $request, Pharmacy $pharmacy)
    {
        $pharmacy->update($request->except('inform'));
        $changes = $pharmacy->getChanges();
        if ($request->input('inform') == 'checked') {
            Mail::to('admin@example.com')->queue(new PharmacyUpdated($pharmacy, $changes));
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
}
