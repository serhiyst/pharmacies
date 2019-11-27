@component('mail::message')

# {{ $pharmacy->sales_rep }} добавил новую аптеку:
<p>{{ $pharmacy->legal_entity }}, {{ $pharmacy->address }},</p>
<p>{{ $pharmacy->city }}, {{ $pharmacy->district }} район</p> 


@component('mail::button', ['url' => '/pharmacy/'.$pharmacy->id])
Подробности
@endcomponent

<br>
{{ config('app.name') }}
@endcomponent
