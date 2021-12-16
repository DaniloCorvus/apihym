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

      <div>
            <div style="width:100% !important;max-width: 10cm !important;text-align:center;">
                <p><strong><span id="impr_Empresa"></span></strong></p>
                <p style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 11px;text-transform: uppercase;">
                    {{$company->Nombre_Empresa}}
                </p>
                <p style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 11px;">NIT:
                    {{$company->NIT}}
                </p>
                <p style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 11px; color: #333;">
                    {{isset($transferencia->Lema) ? $transferencia->Lema : ''}}
                </p>
                <br>

                <p style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 10px; font-weight:bold ">
                  {{$transferencia->Lema}}
                 </p>
              
            </div>

            <br>

            <div style="padding:8px;"></div>

            <div style="width:100% !important;max-width: 10cm !important;">

                <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;">Recibo N°:
                </span>
                <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;" id="">{{$transferencia->Codigo}}</span><br>

                <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;">Fecha: </span>
                <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;" id="">
                    {{\Carbon\Carbon::parse($transferencia->Fecha)->format('Y-m-d')}}
                </span><br>
                <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;">Oficina:
                </span>
                <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$transferencia->NombreOficina}}</span><br>

                <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;">Telefono
                    Oficina: </span>
                <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;">{{$transferencia->TelefonoOficina}}</span><br>

                <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;">Recibido de:
                </span>
                <br>
                <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;" id="">{{$transferencia->Remitente}}</span>

                <br>

                <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;">Telefono:
                </span>
                <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;" id="">{{$transferencia->Telefono}}</span>
                <br>

                <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;">Forma de pago:
                </span>
                <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;" id="">{{$transferencia->Forma_Pago}}</span>
                <br>

                <p style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 10px; font-weight:bold; display: block; margin-top: 15px; text-align:center !important ; ">
                    Datos de Transferencia
                </p>

                <br>

                <div style="padding:15px;"></div>

                <table class="table">
                    <thead style="text-align:center !important ; ">
                        <tr style="text-align:center !important ; ">
                            <th style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 10px; font-weight:bold">Identificación</th>
                            <th style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 10px; font-weight:bold">Nombre</th>
                            <th style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 10px; font-weight:bold">Cuenta Destinatario</th>
                            <th style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 10px; font-weight:bold">Transferido</th>
                        </tr>
                    </thead>
                    @foreach($destinatarios as $destinatario)
                    <tr style="text-align:center !important ; ">
                        <td style="margin: 0 auto;font-family: \'Open Sans Condensed\', sans-serif;font-size: 10px; text-align:center !important ; ">{{$destinatario->Id_Destinatario}}</td>
                        <td style="margin: 0 auto;font-family: \'Open Sans Condensed\', sans-serif;font-size: 10px; text-align:center !important ; ">{{ ucwords(strtolower($destinatario->Nombre_Destinatario)) }}</td>
                        <td style="margin: 0 auto;font-family: \'Open Sans Condensed\', sans-serif;font-size: 10px; text-align:center !important ; ">{{ ucwords(strtolower($destinatario->Numero_Cuenta_Destinatario)) }}</td>
                        <td style="margin: 0 auto;font-family: \'Open Sans Condensed\', sans-serif;font-size: 10px; text-align:center !important ; ">{{$transferencia->MdCodigo .  ' ' .  number_format($destinatario->Valor_Transferencia, 0, ',', '.') }} </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <br>

            <hr>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;">Recibido:
            </span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;" id=""> {{$transferencia->MoCodigo .  ' ' .  number_format($transferencia->Valor_Destino, 0, ',', '.') }} </span>
            <br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;">Tasa:
            </span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;" id="">{{$transferencia->Tasa_Cambio}}</span>
            <br>

            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;">Transferencia:
            </span>
            <span style="margin: 0;font-family: \'Open Sans Condensed\', sans-serif;font-size: 12px;float: right;" id="">{{$transferencia->MdCodigo .  ' ' .  number_format($transferencia->Valor_Origen, 0, ',', '.') }} </span>
            <br>


            <p style="width:100% !important;max-width: 10cm !important;text-align:center;font-size: 12px;">
                <strong><small>{{$transferencia->Footer}}</small></strong>
            </p>
        </div>


</body>

</html>