<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecaudoDestinatario extends Model
{
    use HasFactory;
    
    protected $table = 'Recaudo_Destinatario';
    
    protected $fillable = [
                            'Destinatario_Id',
                            'Recaudo_id', 
                            'Transferido', 
                            'Comision', 
                            'Original', 
                        ];
                        
    // public function remitente (){
    //      return $this->belongsTo(Tercero::class, 'Remitente','Id_Tercero');
    // }
}
