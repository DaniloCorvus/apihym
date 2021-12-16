<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recaudo extends Model
{
    use HasFactory;
    
    protected $table = 'Recaudo';
    protected $fillable = [
                            'Codigo',
                            'Remitente', 
                            'Recibido', 
                            'Transferido', 
                            'Funcionario',
                            'Comision',
                            'Detalle',
                            'Estado'
                        ];
                        
                        public function remitente (){
                             return $this->belongsTo(Tercero::class, 'Remitente','Id_Tercero');
                        }
}
