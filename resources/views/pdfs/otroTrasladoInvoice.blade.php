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
          
          
            <p
                style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 11px;text-transform: uppercase;">
                {{$company->Nombre_Empresa}}
            </p>

            <p style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 11px;">NIT:
                {{$company->NIT}}
            </p>

             <p style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 11px; color: #333;">
                {{$traslado->Lema}}
            </p> 

            <p style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 10px; font-weight:bold ">
                Elaborado por : {{$traslado->full_name}}</p>
          		
          <hr>
          
            <p style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 14px; font-weight: bold">
                  {{isset ($traslado->nameRecibo) ? $traslado->nameRecibo : 'Traslado Entre Terceros' }} 
            </p>

        </div>

        <div style="width:100% !important;max-width: 5cm !important;">

            <br>
            <br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Traslado N°:
            </span>
            <span
                style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$traslado->Codigo}}</span><br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Fecha:
            </span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">
                {{\Carbon\Carbon::parse($traslado->Fecha)->format('Y-m-d h:i:s')}}
            </span><br>
            <span
                style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Oficina:
            </span>
            <span
                style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$traslado->NombreOficina}}</span><br>

          	<!--
            <span
                style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Telefono
                Oficina: </span>
            <span
	         style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$traslado->TelefonoOficina}}</span><br>
			--> 

           
            
            <span
                style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">De {{$traslado->Origen}}:
            </span>
            <br>
          
            <span
                style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$traslado->Enviadopor}} </span>
            <br>
          
           <span
                style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Para  {{$traslado->Destino}} :
            </span>
            <br>
          
           <span
                style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$traslado->Enviadoa}} </span>
            <br>
          
          <!--
            <span
                style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Telefono:
            </span>
            <span
                style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$traslado->TelefonoCliente}}</span>
            <br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Forma
                de pago:</span>
            <span
                style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">Efectivo</span>


            <br>
			 --> 
          
          @if(isset($traslado->Detalle) && $traslado->Detalle != '')
          
            <span
                style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left; ">Concepto:</span>
            <br>
            <span
                style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px; display:block">{{$traslado->Detalle}}</span>

            <br>
            <br>
          
          @endif


            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Valor
                Trasladado</span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">
                {{$traslado->MoCodigo . ' ' . number_format($traslado->Valor, 0, ',', '.') }}</span><br>
          
          <br>
                 <div style="width:100% !important;max-width: 5cm !important;text-align:center;">   
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 20px; font-weight: bold">
              {{(isset($traslado->EstadoEntreCajas) && $traslado->EstadoEntreCajas != 'Aprobado' ) ? $traslado->EstadoEntreCajas : '' }}
           </span>
          </div>
          
        </div>

        <br>
        <br>

        <p style="width:100% !important;max-width: 5cm !important;text-align:center;font-size: 12px;float: left;">
            <strong><small>{{$traslado->Footer}}</small></strong>
        </p>

    </div>

</body>

</html>