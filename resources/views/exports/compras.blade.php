<table>
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Codigo</th>
            <th>Funcionario</th>
            <th>Tercero</th>
            <th>Moneda</th>
            <th>Valor Compra</th>
            <th>Tasa</th>
            <th>Valor Pesos</th>
        </tr>
    </thead>
    <tbody>
        @foreach($compras as $compra)
        <tr>
            
            <td>{{\Carbon\Carbon::parse($compra->Fecha)->format('Y-m-d')}}</td>
            <td>{{$compra->Codigo}}</td>
            <td>{{$compra->Nombre_Funcionario}}</td>
            <td>{{$compra->Nombre_Tercero}}</td>
            <td>{{$compra->Nombre_Moneda}}</td>
            <td>{{number_format ( $compra->Valor_Compra , 0 , "." , "," ) }}</td>
            <td>{{$compra->Tasa}}</td>
            <td>{{number_format ( $compra->Valor_Peso , 0 , "." , "," ) }}</td>
            
            
        </tr>
        @endforeach
    </tbody>
</table>