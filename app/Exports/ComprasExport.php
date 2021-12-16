<?php

namespace App\Exports;

use App\Compra;
use App\Http\Services\CompraService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ComprasExport implements FromView, WithEvents, ShouldAutoSize
{
    private $compraService;

    public function __construct(CompraService $compraService)
    {
        $this->compraService =  $compraService;;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {

        $condicion = $this->compraService->SetCondiciones(request()->all());
        $query = $this->compraService->query($condicion);
        DB::select($query);

        return view('exports.compras', [
            'compras' => DB::select($query)
        ]);
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getStyle($cellRange)->getFont()->setSize(10);
            },
        ];
    }
}
