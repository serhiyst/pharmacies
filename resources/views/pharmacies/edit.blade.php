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
        <option @if("Понедельник" == $pharmacy->day_of_order) selected @endif>Понедельник</option>
        <option @if("Вторник" == $pharmacy->day_of_order) selected @endif>Вторник</option>
        <option @if("Среда" == $pharmacy->day_of_order) selected @endif>Среда</option>
        <option @if("Четверг" == $pharmacy->day_of_order) selected @endif>Четверг</option>
        <option @if("Пятница" == $pharmacy->day_of_order) selected @endif>Пятница</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="day_of_delivery">День доставки</label>
      <select class="form-control" name="day_of_delivery" value="{{$pharmacy->day_of_delivery}}">
        <option></option>
        <option @if("Понедельник" == $pharmacy->day_of_delivery) selected @endif>Понедельник</option>
        <option @if("Вторник" == $pharmacy->day_of_delivery) selected @endif>Вторник</option>
        <option @if("Среда" == $pharmacy->day_of_delivery) selected @endif>Среда</option>
        <option @if("Четверг" == $pharmacy->day_of_delivery) selected @endif>Четверг</option>
        <option @if("Пятница" == $pharmacy->day_of_delivery) selected @endif>Пятница</option>
      </select>
    </div>
    <div class="form-group col-md-1">
      <label for="category">Категория</label>
      <select class="form-control" name="category" value="{{$pharmacy->category}}">
        <option></option>
        <option @if("D1" == $pharmacy->category) selected @endif value="D1">D1</option>
        <option @if("D2" == $pharmacy->category) selected @endif value="D2">D2</option>
        <option @if("D3" == $pharmacy->category) selected @endif value="D3">D3</option>
        <option @if("D4" == $pharmacy->category) selected @endif value="D4">D4</option>  
      </select> 
    </div>
    <div class="form-group col-md-4">
      <label for="equipment">Оборудование</label>
      <input type="text" class="form-control" name="equipment" value="{{$pharmacy->equipment}}">
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

  <button type="submit" class="btn btn-primary">Сохранить изменения</button>
  <button type="submit" form="delete" class="btn btn-danger" onclick="return confirm('Вы действительно хотите удалить эту торговую точку?')">Удалить</button>  
</form>

<form id="delete" method="POST" action="/pharmacies/{{ $pharmacy->id }}">
  @method('DELETE') 
  @csrf
</form>
</div>
@endsection