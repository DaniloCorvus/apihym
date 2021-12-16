<?php

namespace App\Http\Controllers;

use App\Exports\ComprasExport;
use App\Http\Services\CompraService;
use App\Models\Destinatario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;


class InformeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function informeCompra(CompraService $compraService)
    {
        return Excel::download(new ComprasExport($compraService, request()->all()), 'informe-'. Carbon::now()->format('Y-m-d'). '.xlsx');
        // ->headers->set('content-disposition', 'informe-'. Carbon::now()->format('Y-m-d'). '.xlsx');
    }
}
