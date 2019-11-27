@extends('pharmacies.layout')

@section('content')
<div class="container">
<h2>Расширеный поиск</h2>
  <form class="container" method="POST" action="/pharmacies/custom-search">
    @csrf
    <div class="form-group">
      <label for="legal_entity">Юр. лицо</label>
      <input type="text" class="form-control" name="legal_entity">
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="address">Адресс</label>
        <input type="text" class="form-control" name="address">
      </div>
      <div class="form-group col-md-2">
        <label for="city">Город</label>
        <input type="text" class="form-control" name="city">
      </div>
        <div class="form-group col-md-4">
        <label for="district">Район</label>
        <input type="text" class="form-control" name="district">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-2">
        <label for="day_of_order">День заказа</label>
        <select class="form-control" name="day_of_order">
          <option></option>
          <option>Понедельник</option>
          <option>Вторник</option>
          <option>Среда</option>
          <option>Четверг</option>
          <option>Пятница</option>
        </select>
      </div>
      <div class="form-group col-md-2">
        <label for="day_of_delivery">День доставки</label>
        <select class="form-control" name="day_of_delivery">
          <option></option>
          <option>Понедельник</option>
          <option>Вторник</option>
          <option>Среда</option>
          <option>Четверг</option>
          <option>Пятница</option>
        </select>
      </div>
      <div class="form-group col-md-1">
        <label for="category">Категория</label>
        <select class="form-control" name="category">
          <option></option>
          <option>D1</option>
          <option>D2</option>
          <option>D3</option>
          <option>D4</option>
        </select> 
      </div>
      <div class="form-group col-md-4">
        <label for="equipment">Оборудование</label>
        <input type="text" class="form-control" name="equipment">
      </div>

      @if (auth()->user()->name == 'Овчаренко Анатолий') <div class="form-group col-md-3">
        <label for="sales_rep">Торговый представитель</label>
        <select class="form-control" name="sales_rep">
          <option></option>
          <option>Михайлов Илья</option>
          <option>Шарапов Денис</option>
          <option>Таранец Юрий</option>
          <option>Анисимов Сергей</option>  
        </select> 
      </div>
      @endif
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="pharmacy_manager">Заведующая аптеки</label>
        <input type="text" class="form-control" name="pharmacy_manager">
      </div>
      <div class="form-group col-md-2">
        <label for="phone_number">Номер телефона</label>
        <input type="text" class="form-control" name="phone_number">
      </div>
      <div class="form-group col-md-4">
        <label for="email">E-mail</label>
        <input type="text" class="form-control" name="email" >
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Поиск</button>
    <a class="btn btn-secondary" href="{{ url('/pharmacies') }}">Назад</a>
  </form>
</div>
@endsection