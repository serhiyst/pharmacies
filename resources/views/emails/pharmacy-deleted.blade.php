@component('mail::message')

# {{ $pharmacy->sales_rep }} удалил аптеку:

>{{ $pharmacy->legal_entity }}, {{ $pharmacy->address }},        
>{{ $pharmacy->city }}, {{ $pharmacy->district }} район


@component('mail::button', ['url' => '/pharmacy/'])
К списку аптек
@endcomponent

<br>
{{ config('app.name') }}
@endcomponent