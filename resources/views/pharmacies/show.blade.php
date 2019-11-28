@extends('pharmacies.layout')

@section('content')
<div class="container">
  <h2>Подробности</h2>
  <p>
	<dl class="row">
	  <dt class="col-sm-3">Юр. Лицо</dt>
	  <dd class="col-sm-9">{{ $pharmacy->legal_entity }}</dd>

	  <dt class="col-sm-3">Адрес</dt>
	  <dd class="col-sm-9">{{ $pharmacy->address }}
		  				   <p>{{$pharmacy->city }}, {{$pharmacy->district }} район</p></dd>

	  <dt class="col-sm-3"><p>Торговый представитель</p></dt>
	  <dd class="col-sm-9">{{ $pharmacy->sales_rep }}</dd>

	  <dt class="col-sm-3 text-truncate">Категория</dt>
	  <dd class="col-sm-9">{{ $pharmacy->category }}</dd>

	  <dt class="col-sm-3">День заказа</dt>
	  <dd class="col-sm-9">{{ $pharmacy->day_of_order }}</dd>

	  <dt class="col-sm-3">День доставки</dt>
	  <dd class="col-sm-9">{{ $pharmacy->day_of_delivery }}</dd>

	  <dt class="col-sm-3"><p>Оборудование</p></dt>
	  <dd class="col-sm-9">{{ $pharmacy->equipment }}</dd>

	  <dt class="col-sm-3">Заведующая аптеки</dt>
	  <dd class="col-sm-9">{{ $pharmacy->pharmacy_manager }}</dd>

	  <dt class="col-sm-3">Номер телефона</dt>
	  <dd class="col-sm-9">{{ $pharmacy->phone_number }}</dd>

	  <dt class="col-sm-3"><p>E-Mail</p></dt>
	  <dd class="col-sm-9">{{ $pharmacy->email }}</dd>

	  <div>
	  	<a href="/pharmacies/{{ $pharmacy->id }}/edit" class="btn btn-primary">Редактировать</a>
	  	<button type="submit" form="delete" class="btn btn-danger" onclick="return confirm('Вы действительно хотите удалить эту торговую точку?')">Удалить</button>
	    <a class="btn btn-secondary" href="{{ url('/pharmacies') }}">Назад</a>
	  </div>
	 
	  <form id="delete" method="POST" action="/pharmacies/{{ $pharmacy->id }}">
	    @method('DELETE') 
	  	@csrf
	  </form> 
	</dl>
  </p>
</div>
@endsection