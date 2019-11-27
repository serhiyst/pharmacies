@extends('pharmacies.layout')

@section('content')
<div class="container">
<h2>Редактирование</h2>
<form class="container" method="POST" action="/pharmacies/{{ $pharmacy->id }}">
	@method('PATCH')
  @csrf
  <div class="form-group">
    <label for="legal_entity">Юр. лицо</label>
    <input type="text" class="form-control" name="legal_entity" value="{{$pharmacy->legal_entity}}">
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="address">Адресс</label>
      <input type="text" class="form-control" name="address" value="{{$pharmacy->address}}">
    </div>
    <div class="form-group col-md-2">
      <label for="city">Город</label>
      <input type="text" class="form-control" name="city" value="{{$pharmacy->city}}">
    </div>
    <div class="form-group col-md-4">
      <label for="district">Район</label>
      <input type="text" class="form-control" name="district" value="{{$pharmacy->district}}">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-2">
      <label for="day_of_order">День заказа</label>
      <select class="form-control" name="day_of_order" value="{{$pharmacy->day_of_order}}">
        <option></option>
        <option @if("понедельник" == $pharmacy->day_of_order) selected @endif>понедельник</option>
        <option @if("вторник" == $pharmacy->day_of_order) selected @endif>вторник</option>
        <option @if("среда" == $pharmacy->day_of_order) selected @endif>среда</option>
        <option @if("четверг" == $pharmacy->day_of_order) selected @endif>четверг</option>
        <option @if("пятница" == $pharmacy->day_of_order) selected @endif>пятница</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="day_of_delivery">День доставки</label>
      <select class="form-control" name="day_of_delivery" value="{{$pharmacy->day_of_delivery}}">
        <option></option>
        <option @if("понедельник" == $pharmacy->day_of_delivery) selected @endif>понедельник</option>
        <option @if("вторник" == $pharmacy->day_of_delivery) selected @endif>вторник</option>
        <option @if("среда" == $pharmacy->day_of_delivery) selected @endif>среда</option>
        <option @if("четверг" == $pharmacy->day_of_delivery) selected @endif>четверг</option>
        <option @if("пятница" == $pharmacy->day_of_delivery) selected @endif>пятница</option>
      </select>
    </div>
    <div class="form-group col-md-1">
      <label for="category">Категория</label>
      <select class="form-control" name="category" value="{{$pharmacy->category}}">
        <option></option>
        <option @if("D1" == $pharmacy->category) selected @endif>D1</option>
        <option @if("D2" == $pharmacy->category) selected @endif>D2</option>
        <option @if("D3" == $pharmacy->category) selected @endif>D3</option>
        <option @if("D4" == $pharmacy->category) selected @endif>D4</option>  
      </select> 
    </div>
    <div class="form-group col-md-4">
      <label for="equipment">Оборудование</label>
      <input type="text" class="form-control" name="equipment" value="{{$pharmacy->equipment}}">
    </div>

    <div class="form-group col-md-3">
      <label for="sales_rep">Торговый представитель</label>
      <select class="form-control" name="sales_rep" value="{{$pharmacy->sales_rep}}">
        <option></option>
        <option @if("Михайлов Илья" == $pharmacy->sales_rep) selected @endif>Михайлов Илья</option>
        <option @if("Шарапов Денис" == $pharmacy->sales_rep) selected @endif>Шарапов Денис</option>
        <option @if("Таранец Юрий" == $pharmacy->sales_rep) selected @endif>Таранец Юрий</option>
        <option @if("Анисимов Сергей" == $pharmacy->sales_rep) selected @endif>Анисимов Сергей</option>  
      </select> 
    </div>

  </div>


  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="pharmacy_manager">Заведующая аптеки</label>
      <input type="text" class="form-control" name="pharmacy_manager" value="{{$pharmacy->pharmacy_manager}}">
    </div>
    <div class="form-group col-md-2">
      <label for="phone_number">Номер телефона</label>
      <input type="text" class="form-control" name="phone_number" value="{{$pharmacy->phone_number}}">
    </div>
    <div class="form-group col-md-4">
      <label for="email">E-mail</label>
      <input type="text" class="form-control" id="email" value="{{$pharmacy->email}}">
    </div>
  </div>
  <div class="form-group form-check"> 
    <input type="checkbox" class="form-check-input" name="inform" value="checked">
    <label for="inform" class="form-check-label">Уведомить руководителя об изменениях</label>
  </div>  

  <div>
  <button type="submit" class="btn btn-primary">Сохранить изменения</button>
  <button type="submit" form="delete" class="btn btn-danger" onclick="return confirm('Вы действительно хотите удалить эту торговую точку?')">Удалить</button> 
  <a class="btn btn-secondary" href="{{ url('/pharmacies') }}">Назад</a>
  </div> 
</form>

<form id="delete" method="POST" action="/pharmacies/{{ $pharmacy->id }}">
  @method('DELETE') 
  @csrf
</form>
{{-- <input action="action" onclick="window.history.go(-1); return false;" type="button" value="Back" > --}}
</div>
@endsection