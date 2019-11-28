@component('mail::message')

# {{ $pharmacy->sales_rep }} добавил новую аптеку:

>{{ $pharmacy->legal_entity }}, {{ $pharmacy->address }},    
>{{ $pharmacy->city }}, {{ $pharmacy->district }} район 


@component('mail::button', ['url' => '/pharmacy/'.$pharmacy->id])
Подробности
@endcomponent

<br>
{{ config('app.name') }}
@endcomponent
