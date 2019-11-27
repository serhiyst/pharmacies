@extends('pharmacies.layout')

@section('content')
<div>
  <h2>База аптек</h2>        
  <table class="table table-bordered" id="table1">
    <thead>
      <tr>
        {{-- <th>id</th> --}}
        <th>N</th>
        <th>Logo</th>
        <th>Юр. Лицо</th>
        <th>Адрес</th>
        <th>Город</th>
        <th>Район</th>
        <th>Торговый представитель</th>
        <th>Категория</th>
        {{-- <th>День заказа</th> --}}
        <th>День доставки</th>
        {{-- <th>Оборудование</th> --}}
        <th>Заведующий аптеки</th>
        <th>Номер телефона</th>
        {{-- <th>E-Mail</th> --}}
        <th width="60px">Действие</th>                
      </tr>
      @foreach($pharmacy as $datas)
      <tr class="table-tr-hover" onclick="location.href = '/pharmacies/{{ $datas->id }}';">
        {{-- <td>{{ $datas->id }}</td> --}}
        <td>{{++$counter}}</td>
        <td>
        @if(in_array($datas->legal_entity, $anc)) <img src="/images/anc.png">  
        @elseif(in_array($datas->legal_entity, $aptekar)) <img src="/images/aptekar.jpg">  
        @elseif(in_array($datas->legal_entity, $vitamin)) <img src="/images/vitamin.png">  
        @elseif(in_array($datas->legal_entity, $tas)) <img src="/images/tas.jpg">  
        @elseif(in_array($datas->legal_entity, $pharmastor)) <img src="/images/pharmastor.jpg">
        @else <img src="/images/retail.jpg">  
        @endif 
        </td>
        <td>{{ $datas->legal_entity }}</td>
        <td>{{ $datas->address }}</td>
        <td>{{ $datas->city }}</td>
        <td>{{ $datas->district }}</td>
        <td>{{ $datas->sales_rep }}</td>
        <td>{{ $datas->category }}</td>
        {{-- <td>{{ $datas->day_of_order }}</td> --}}
        <td>{{ $datas->day_of_delivery }}</td>
        {{-- <td>{{ $datas->equipment }}</td> --}}
        <td>{{ $datas->pharmacy_manager }}</td>
        <td>{{ $datas->phone_number }}</td>
        {{-- <td>{{ $datas->email }}</td> --}}
        <td><a href="/pharmacies/{{ $datas->id }}/edit" class="edit btn btn-primary btn-sm">Редактировать</a>
      </tr>
      @endforeach
    </thead>
  </table>
</div>
@endsection