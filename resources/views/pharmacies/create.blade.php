@extends('pharmacies.layout')

@section('content')
<div class="container">
<h2>Добавить аптеку</h2>
  <form class="container" method="POST" action="/pharmacies">
    @csrf
    <div class="form-group">
      <label for="legal_entity">Юр. лицо</label>
      <input type="text" class="form-control" name="legal_entity" value="{{ old('legal_entity') }}" required>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="address">Адресс</label>
        <input type="text" class="form-control" name="address" value="{{ old('address') }}" required>
      </div>
      <div class="form-group col-md-2">
        <label for="city">Город</label>
        <input type="text" class="form-control" name="city" value="{{ old('city') }}" required>
      </div>
        <div class="form-group col-md-4">
        <label for="district">Район</label>
        <input type="text" class="form-control" name="district" value="{{ old('district') }}" required>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-2">
        <label for="day_of_order">День заказа</label>
        <select class="form-control" name="day_of_order" value="{{ old('day_of_order') }}" required>
          <option>{{ old('day_of_order') }}</option>
          <option>понедельник</option>
          <option>вторник</option>
          <option>среда</option>
          <option>четверг</option>
          <option>пятница</option>
        </select>
      </div>
      <div class="form-group col-md-2">
        <label for="day_of_delivery">День доставки</label>
        <select class="form-control" name="day_of_delivery" value="{{ old('day_of_delivery') }}" required>
          <option>{{ old('day_of_delivery') }}</option>
          <option>понедельник</option>
          <option>вторник</option>
          <option>среда</option>
          <option>четверг</option>
          <option>пятница</option>
        </select>
      </div>
      <div class="form-group col-md-1">
        <label for="category">Категория</label>
        <select class="form-control" name="category" required>
          <option>{{ old('category') }}</option>
          <option>D1</option>
          <option>D2</option>
          <option>D3</option>
          <option>D4</option>
        </select> 
      </div>
      <div class="form-group col-md-4">
        <label for="equipment">Оборудование</label>
        <input type="text" class="form-control" name="equipment" value="{{ old('equipment') }}">
      </div>
      <div class="form-group col-md-3">
        <input type="hidden" class="form-control" name="sales_rep" value="{{ auth()->user()->name }}">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="pharmacy_manager">Заведующая аптеки</label>
        <input type="text" class="form-control" name="pharmacy_manager" value="{{ old('pharmacy_manager') }}">
      </div>
      <div class="form-group col-md-2">
        <label for="phone_number">Номер телефона</label>
        <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}">
      </div>
      <div class="form-group col-md-4">
        <label for="email">E-mail</label>
        <input type="text" class="form-control" name="email" value="{{ old('email') }}">
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Добавить</button>
    <a class="btn btn-secondary" href="{{ url('/pharmacies') }}">Назад</a>
  </form>

@include('pharmacies.errors')
</div>
@endsection