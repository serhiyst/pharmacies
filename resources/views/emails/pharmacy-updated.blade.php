@component('mail::message')
# В данные аптеки {{$pharmacy->legal_entity}}, {{$pharmacy->address}} внесены изменения
# Список изменений:
<ul style="list-style-type: none;">
  @foreach($changes as $key => $change)
    <li>
	  @switch($key)
	  @case('legal_entity')
	  {{'Юр. лицо: '.$change}}
	  @break
	  @case('address')
	  {{'Адрес: '.$change}}
	  @break
	  @case('city')
	  {{'Город: '.$change}}
	  @break
	  @case('district')
	  {{'Район: '.$change}}
	  @break
	  @case('sales_rep')
	  {{'Торговый представитель: '.$change}}
	  @break
	  @case('category')
	  {{'Категория: '.$change}}
	  @break
	  @case('day_of_order')
	  {{'День заказа: '.$change}}
	  @break
	  @case('day_of_delivery')
	  {{'День доставки: '.$change}}
	  @break
	  @case('equipment')
	  {{'Оборудование: '.$change}}
	  @break
	  @case('pharmacy_manager')
	  {{'Заведующий аптеки: '.$change}}
	  @break
	  @case('phone_number')
	  {{'Номер телефона: '.$change}}
	  @break
	  @case('email')
	  {{'E-Mail: '.$change}}
	  @break
      @endswitch
    </li>
  @endforeach
</ul>
@component('mail::button', ['url' => '/pharmacy/'.$pharmacy->id])
Подробности
@endcomponent

<br>
{{ config('app.name') }}
@endcomponent
