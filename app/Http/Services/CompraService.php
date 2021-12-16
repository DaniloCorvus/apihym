<?php

namespace App\Http\Services;

class CompraService
{
    public function SetCondiciones($req)
    {

        $condicion = '';

        if (isset($req['fecha']) && $req['fecha'] != "") {
            if ($condicion != "") {
                $condicion .= " AND DATE(C.Fecha) = '" . $req['fecha'] . "'";
            } else {
                $condicion .=  " WHERE DATE(C.Fecha) = '" . $req['fecha'] . "'";
            }
        }

        if (isset($req['codigo']) && $req['codigo'] != "") {
            if ($condicion != "") {
                $condicion .= " AND C.Codigo LIKE '%" . $req['codigo'] . "%'";
            } else {
                $condicion .=  " WHERE C.Codigo LIKE '%" . $req['codigo'] . "%'";
            }
        }

        if (isset($req['funcionario']) && $req['funcionario'] != "") {
            if ($condicion != "") {
                $condicion .= " AND CONCAT_WS(' ', F.Nombres, F.Apellidos) LIKE '%" . $req['funcionario'] . "%'";
            } else {
                $condicion .=  " WHERE CONCAT_WS(' ', F.Nombres, F.Apellidos) LIKE '%" . $req['funcionario'] . "%'";
            }
        }

        if (isset($req['tercero']) && $req['tercero'] != "") {
            if ($condicion != "") {
                $condicion .= " AND T.Nombre LIKE '%" . $req['tercero'] . "%'";
            } else {
                $condicion .=  " WHERE T.Nombre LIKE '%" . $req['tercero'] . "%'";
            }
        }

        if (isset($req['moneda']) && $req['moneda'] != "") {
            if ($condicion != "") {
                $condicion .= " AND C.Id_Moneda_Compra = " . $req['moneda'];
            } else {
                $condicion .=  " WHERE C.Id_Moneda_Compra = " . $req['moneda'];
            }
        }

        return $condicion;
    }

    public function query($condicion)
    {
        return '
        SELECT 
            C.*,
            CONCAT_WS(" ", F.Nombres, F.Apellidos) AS Nombre_Funcionario,
            T.Nombre AS Nombre_Tercero,
            M.Nombre AS Nombre_Moneda,
            M.Codigo AS Codigo_Moneda
        FROM Compra C
            INNER JOIN Funcionario F ON C.Id_Funcionario = F.Identificacion_Funcionario
            INNER JOIN Tercero T ON C.Id_Tercero = T.Id_Tercero
            INNER JOIN Moneda M ON C.Id_Moneda_Compra = M.Id_Moneda '
            . $condicion .
            ' ORDER BY C.Fecha DESC';
    }
}
