@extends('pharmacies.layout')

@section('content')
<div>
  <h2>База аптек</h2>        
  <table class="table table-bordered" id="table1">
    <thead>
      <tr>
        <th>N</th>
        <th>Logo</th>
        <th>Юр. Лицо</th>
        <th>Адрес</th>
        <th>Город</th>
        <th>Район</th>
        <th>Торговый представитель</th>
        <th>Категория</th>
        <th>День доставки</th>
        <th>Заведующий аптеки</th>
        <th>Номер телефона</th>
        <th width="60px">Действие</th>                
      </tr>
      @foreach ($pharmacy as $data)
        <tr class="table-tr-hover" onclick="location.href = '/pharmacies/{{ $data->id }}';">
          <td>{{ ++$counter }}</td>
          <td>
            @if (in_array($data->legal_entity, $anc)) <img src="/images/anc.png">  
            @elseif (in_array($data->legal_entity, $aptekar)) <img src="/images/aptekar.jpg">  
            @elseif (in_array($data->legal_entity, $vitamin)) <img src="/images/vitamin.png">  
            @elseif (in_array($data->legal_entity, $tas)) <img src="/images/tas.jpg">  
            @elseif (in_array($data->legal_entity, $pharmastor)) <img src="/images/pharmastor.jpg">
            @else <img src="/images/retail.jpg">  
            @endif 
          </td>
          <td>{{ $data->legal_entity }}</td>
          <td>{{ $data->address }}</td>
          <td>{{ $data->city }}</td>
          <td>{{ $data->district }}</td>
          <td>{{ $data->sales_rep }}</td>
          <td>{{ $data->category }}</td>
          <td>{{ $data->day_of_delivery }}</td>
          <td>{{ $data->pharmacy_manager }}</td>
          <td>{{ $data->phone_number }}</td>
          <td><a href="/pharmacies/{{ $data->id }}/edit" class="edit btn btn-primary btn-sm">Редактировать</a>
        </tr>
      @endforeach
    </thead>
  </table>
</div>
@endsection