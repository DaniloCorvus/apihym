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
                {{$externo->Lema}}
            </p>
            
            <p style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 10px; font-weight:bold ">
                    Elaborado por : {{$externo->Nombre}}</p>

        </div>


        <div style="width:100% !important;max-width: 5cm !important;">

            <br>
            <br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Recibo N:
            </span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$externo->Codigo}}</span><br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Fecha: </span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">
                {{\Carbon\Carbon::parse($externo->Fecha)->format('Y-m-d')}}
            </span><br>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Oficina:
            </span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$externo->NombreOficina}}</span><br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Telefono
                Oficina: </span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$externo->TelefonoOficina}}</span><br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Responsable:
            </span>
            <br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$externo->Nombre}}</span>
            <br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Forma de pago:</span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">Efectivo</span>
            <br>
            <br>

            <p style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px; font-weight: bold">
                Servicio Externo
            </p>
            <br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Tipo de Servicio:</span>
            <br>

            <span style="width:100% !important; margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px; text-align:center !important; "> {{($externo->ServicioExterno )  }}</span>
            <br>
            <br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Valor</span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">$ {{ number_format($externo->Valor , 0, ',', '.')  }}</span>
            <br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Comision</span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">$ {{ number_format($externo->Comision, 0, ',', '.')   }}</span>
            <br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: left;">Total</span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">$ {{ number_format( $externo->Valor + $externo->Comision, 0, ',', '.')  }}</span>
            <br>

        </div>

        <br>
        <br>

        <p style="width:100% !important;max-width: 5cm !important;text-align:center;font-size: 12px;float: left;">
            <strong><small>{{$externo->Footer}}</small></strong>
        </p>

    </div>

</body>

</html>