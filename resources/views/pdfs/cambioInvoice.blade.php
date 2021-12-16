<!DOCTYPE html>
<html>

<head>
    <title>Recibo</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="author" content="francesc ricart" />
</head>

<body>


    <div>

        <div style="width:100% !important;max-width: 5cm !important;text-align:center;">

            <p style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 11px;text-transform: uppercase;">
                {{$company->Nombre_Empresa}}
            </p>

            <p style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 11px;">NIT:
                {{$company->NIT}}
            </p>

            <p style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 11px; color: #333;">
                {{$cambio->Lema}}
            </p>
            
             <p style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 10px; font-weight:bold ">
                    Elaborado por : {{$cambio->full_name}}</p>
          
          	<br>
            <p style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 18px; font-weight: bold">
               {{$cambio->Tipo}} - {{$cambio->FormaPago}}  </p>
           
          

        </div>


        <div style="width:100% !important;max-width: 5cm !important;">

            <br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 14px;float: left;">{{($cambio->Tipo == 'Venta') ? 'Venta Nº :' : 'Compra Nº :' }}
            </span>
                    
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 14px;float: right;">{{$cambio->Codigo}}</span><br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Fecha: </span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">
                {{\Carbon\Carbon::parse($cambio->Fecha)->format('Y-m-d h:i:s')}}
            </span><br>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Oficina:
            </span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$cambio->NombreOficina}}</span><br>

          	
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Telefono
                Oficina: </span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$cambio->TelefonoOficina}}</span><br>
			
          
             @if($cambio->FormaPago != 'Efectivo')
             <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">
                {{ ($cambio->Tipo == 'Venta') ? 'Cobrado a :' : ' Recibido de :' }}
             </span>
             <br>
          
           <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$cambio->Nombre}}</span>
          
            <br>
          
          	@endif
          
           
          
            <!--
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Telefono:
            </span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$cambio->TelefonoCliente}}</span>
            <br>
			--> 

          <!--
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Forma de pago:</span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$cambio->FormaPago}}</span>
            <br>
            --> 
          
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">{{(isset($cambio->Observacion) && $cambio->Observacion != '') ? 'Observaciones :' .  $cambio->Observacion : '' }}</span>
          
          
			<br>
         	<br>
            
          
           

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Moneda
                {{$cambio->Tipo}}:</span>
          
          	@if($cambio->Tipo == 'Venta')
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$cambio->MdCodigo}}</span><br>
			@endif
          
            @if($cambio->Tipo == 'Compra')
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$cambio->MoCodigo}}</span><br>
			@endif
          
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Valor
                {{$cambio->Tipo}}:</span>
          
          	@if($cambio->Tipo == 'Venta')
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$cambio->MdCodigo .  ' ' .  number_format(  $cambio->Valor_Destino , 0, ',', '.') }}</span><br>
			@endif
          
            @if($cambio->Tipo == 'Compra')
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$cambio->MoCodigo .  ' ' .  number_format(  $cambio->Valor_Origen , 0, ',', '.') }}</span><br>
			@endif
          
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Tasa:</span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$cambio->Tasa}}</span><br>
          
          

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 14px;float: left;">Valor
                {{($cambio->Tipo == 'Compra' ) ? ' Entregado' : ' Total'  }}</span>
          
          
           
          
           @if($cambio->Tipo == 'Venta')
          	
          
      
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">
              
              @if($cambio->FormaPago == 'Crédito') 
          		{{'('}}
               @endif
              
              {{$cambio->MoCodigo .  ' ' .  number_format($cambio->Valor_Origen, 0, ',', '.') }}
          
               @if($cambio->FormaPago == 'Crédito') 
          		{{')'}}
               @endif
              
          </span><br>
		  	
          @endif
          
           @if($cambio->Tipo == 'Compra')
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">
              
               @if($cambio->FormaPago == 'Crédito') 
          		{{'('}}
               @endif
              
              {{$cambio->MdCodigo .  ' ' .  number_format($cambio->Valor_Destino, 0, ',', '.') }}
          
              @if($cambio->FormaPago == 'Crédito') 
          		{{')'}}
               @endif
              
          </span><br>
		   @endif
          
          
          
        </div>

        <br>
        <br>

        <p style="width:100% !important;max-width: 5cm !important;text-align:center;font-size: 12px;float: left;">
            <strong><small>{{$cambio->Footer}}</small></strong>
        </p>

    </div>

</body>

</html>