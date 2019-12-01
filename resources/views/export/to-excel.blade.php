<table>
  <thead>
    <tr>
      <th>N</th>
      <th>Юр. Лицо</th>
      <th>Адрес</th>
      <th>Город</th>
      <th>Район</th>
      <th>Торговый представитель</th>
      <th>Категория</th>
      <th>День доставки</th>
      <th>Заведующий аптеки</th>
      <th>Номер телефона</th>        
     </tr>
     @foreach ($pharmacy as $data)
      <tr>
        <td>{{ ++$counter }}</td>
        <td>{{ $data->legal_entity }}</td>
        <td>{{ $data->address }}</td>
        <td>{{ $data->city }}</td>
        <td>{{ $data->district }}</td>
        <td>{{ $data->sales_rep }}</td>
        <td>{{ $data->category }}</td>
        <td>{{ $data->day_of_delivery }}</td>
        <td>{{ $data->pharmacy_manager }}</td>
        <td>{{ $data->phone_number }}</td>
      </tr>
     @endforeach
  </thead>
</table>
     
