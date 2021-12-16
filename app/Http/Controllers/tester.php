<?php
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
  header('Content-Type: application/json');

  include_once('../../class/class.querybasedatos.php');
  include_once('../../class/class.paginacion.php');

  $pagina = ( isset( $_REQUEST['pag'] ) ? $_REQUEST['pag'] : '' );
  $pageSize = ( isset( $_REQUEST['tam'] ) ? $_REQUEST['tam'] : '' );

  $id_funcionario  = (isset($_REQUEST['id_funcionario']) && $_REQUEST['id_funcionario'] != '') ? $_REQUEST['id_funcionario'] : '';

  $query_paginacion = '
      SELECT 
        COUNT(T.Id_Transferencia) AS Total
      FROM Transferencia T
      INNER JOIN Recibo R ON T.Id_Transferencia = R.Id_Transferencia
      INNER JOIN Funcionario F ON T.Identificacion_Funcionario = F.Identificacion_Funcionario
      LEFT JOIN Transferencia_Remitente TR ON T.Documento_Origen = TR.Id_Transferencia_Remitente
      LEFT JOIN Tercero TER ON T.Documento_Origen = TER.Id_Tercero WHERE T.Identificacion_Funcionario = 9999999 AND DATE(T.Fecha) = cast(CURRENT_DATE as date)';

  $query = '
      SELECT 
        T.*,
        IF(LOWER(T.Forma_Pago) = "credito", (T.Cantidad_Transferida + T.Cantidad_Recibida_Bolsa_Bolivares), T.Cantidad_Transferida) AS Monto_Transferido,
        IF(T.Tipo_Transferencia = "Cliente", (SELECT TE.Nombre FROM Movimiento_Tercero MT INNER JOIN Tercero TE ON MT.Id_Tercero = TE.Id_Tercero WHERE 				   			MT.Valor_Tipo_Movimiento = T.Id_Transferencia), "") AS Cliente_Transferencia,
        R.Id_Recibo,
        R.Codigo AS CodigoRecibo,
        TR.Nombre AS Remitente,
        CONCAT_WS(" ", F.Nombres, F.Apellidos) AS Cajero,
        (SELECT Codigo FROM Moneda WHERE Id_Moneda = T.Moneda_Origen) AS Codigo_Moneda_Origen,
        (SELECT Codigo FROM Moneda WHERE Id_Moneda = T.Moneda_Destino) AS Codigo_Moneda_Destino        
      	FROM Transferencia T
      	INNER JOIN Recibo R ON T.Id_Transferencia = R.Id_Transferencia
      	INNER JOIN Funcionario F ON T.Identificacion_Funcionario = F.Identificacion_Funcionario
      	LEFT JOIN Transferencia_Remitente TR ON T.Documento_Origen = TR.Id_Transferencia_Remitente
      	LEFT JOIN Tercero TER ON T.Documento_Origen = TER.Id_Tercero
       	WHERE T.Identificacion_Funcionario = 9999999 AND DATE(T.Fecha) = cast(CURRENT_DATE as date)
      	ORDER BY T.Fecha DESC';

  $paginationObj = new PaginacionData($pageSize, $query_paginacion,  $pagina);
  $queryObj = new QueryBaseDatos($paginationObj);
  
  $result = $queryObj->Consultar('Multiple', false, $paginationObj);

  if (count($result['query_data']) > 0) {
  	
  	echo json_encode($result);
  	
//   	$result['query_data'] = GetRemitentesTransferencias($result['query_data']);
  }

  unset($queryObj);
  unset($paginationObj);
  
  echo json_encode($result);

  function SetCondiciones($req){
  	global $id_funcionario;

        $condicion = ' WHERE T.Identificacion_Funcionario = '.$id_funcionario.' AND DATE(T.Fecha) = "'.date('Y-m-d').'"';

        if (isset($req['recibo']) && $req['recibo'] != "") {
        	if ($condicion != "") {
                $condicion .= " AND R.Codigo LIKE '%".$req['recibo']."%'";
            } else {
                $condicion .=  " WHERE R.Codigo LIKE '%".$req['recibo']."%'";
            }
        }

        if (isset($req['remitente']) && $req['remitente'] != "") {
        	if ($condicion != "") {
                $condicion .= " AND (TR.Nombre LIKE '%".$req['remitente']."%' OR TER.Nombre LIKE '%".$req['remitente']."%')";
            } else {
                $condicion .= " WHERE (TR.Nombre LIKE '%".$req['remitente']."%' OR TER.Nombre LIKE '%".$req['remitente']."%')";
            }
        }

        if (isset($req['recibido']) && $req['recibido'] != "") {
        	if ($condicion != "") {
                $condicion .= " AND T.Cantidad_Recibida = ".$req['recibido'];
            } else {
                $condicion .=  " WHERE T.Cantidad_Recibida = ".$req['recibido'];
            }
        }

        if (isset($req['transferido']) && $req['transferido'] != "") {
        	if ($condicion != "") {
                $condicion .= " AND T.Cantidad_Transferida = ".$req['transferido'];
            } else {
                $condicion .=  " WHERE T.Cantidad_Transferida = ".$req['transferido'];
            }
        }

        if (isset($req['tasa']) && $req['tasa'] != "") {
        	if ($condicion != "") {
                $condicion .= " AND T.Tasa_Cambio = ".number_format($req['tasa'], 2, ".", "");
            } else {
                $condicion .=  " WHERE T.Tasa_Cambio = ".number_format($req['tasa'], 2, ".", "");
            }
        }

        if (isset($req['estado']) && $req['estado']) {
            if ($condicion != "") {
                $condicion .= " AND T.Estado = '".$req['estado']."'";
            } else {
                $condicion .= " WHERE T.Estado = '".$req['estado']."'";
            }
        }
        
        return $condicion;
    }

    function GetRemitentesTransferencias($transferencias){

    	$i = 0;
    	foreach ($transferencias as $t) {
    		
    		if ($t['Tipo_Origen'] == 'Remitente') {
    			
    			$transferencias[$i]['Remitente'] = GetRemitente('Transferencia_Remitente', $t['Documento_Origen']);

    		}else{

    			$transferencias[$i]['Remitente'] = GetRemitente('Tercero', $t['Documento_Origen']);
    		}

        $i++;
    	}

  		return $transferencias;
    }

    function GetRemitente($tabla, $id_remitente){
    	global $queryObj;

    	$query = '
		      SELECT 
		        Nombre
		      FROM '.$tabla.'
		      WHERE
		      	Id_'.$tabla.' = '.$id_remitente;

    	$queryObj->SetQuery($query);
  		$remitente = $queryObj->ExecuteQuery('simple');

  		return $remitente['Nombre'];
    }
?>