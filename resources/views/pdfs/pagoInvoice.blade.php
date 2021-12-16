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
                {{$pago->Lema}}
            </p>
            <p style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 10px; font-weight:bold ">
                    Elaborado por : {{$pago->full_name}}</p>

        </div>


        <div style="width:100% !important;max-width: 5cm !important;">

            <br>
            <br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Recibo N°:
            </span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$pago->Codigo}}</span><br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Fecha: </span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">
                {{\Carbon\Carbon::parse($pago->Fecha)->format('Y-m-d')}}
            </span><br>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Oficina:
            </span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$pago->NombreOficina}}</span><br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Telefono
                Oficina: </span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$pago->TelefonoOficina}}</span><br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Recibido de:
            </span>
            <br>
            
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$pago->Nombre}}</span>
            <br>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Telefono:
            </span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$pago->TelefonoCliente}}</span>
            <br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Forma de pago:</span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$pago->FormaPago}}</span>
            <br>
            <br>

            <p style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px; font-weight: bold">
                Pago</p>
            <br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Destinatario:</span>
            <br>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$pago->Nombre_Destinatario}}</span>
            <br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">CC:</span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$pago->Documento_Destinatario}}</span>
            <br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Telefono:</span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$pago->Telefono_Destinatario}}</span>
            <br>

            <hr>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Moneda
                {{$pago->Tipo}}:</span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$pago->MoCodigo}}</span><br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Valor
                {{$pago->Tipo}}:</span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$pago->MoCodigo .  ' ' .  number_format(  $pago->Valor_Origen , 0, ',', '.') }}</span><br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Comisión:</span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{ number_format($pago->Tasa, 0, ',', '.') }}</span><br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Valor
                {{($pago->Tipo == 'Compra' ) ? ' Entregado' : ' Recibido'  }}</span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$pago->MdCodigo .  ' ' .  number_format($pago->Valor_Total, 0, ',', '.') }}</span><br>

        </div>

        <br>
        <br>

        <p style="width:100% !important;max-width: 5cm !important;text-align:center;font-size: 12px;float: left;">
            <strong><small>{{$pago->Footer}}</small></strong>
        </p>

    </div>

</body>

</html>