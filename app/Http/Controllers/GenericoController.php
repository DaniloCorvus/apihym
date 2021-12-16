<?php

namespace App\Http\Controllers;

use App\Models\DocumentoExtranjero;
use App\Models\DocumentoNacional;
use App\Models\Pais;
use Illuminate\Http\Request;

class GenericoController extends Controller
{
    public function tipoDocumentosExtranjeros()
    {
        if (request()->wantsJson()) {
            return response()->json(DocumentoExtranjero::all());
        }
    }

    public function tipoDocumentoNacionales()
    {
        if (request()->wantsJson()) {
            return response()->json(DocumentoNacional::all());
        }
    }

    public function paises()
    {
        if (request()->wantsJson()) {
            return  Pais::all();
        }
    }
}
