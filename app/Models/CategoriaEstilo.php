<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaEstilo extends Model
{
    use HasFactory;

    protected $table = 'categoria_estilos';
    // ... otras propiedades y métodos del modelo ...
    public function categoriaCliente()
    {
        return $this->belongsTo(CategoriaCliente::class, 'categoria_cliente_id');
    }
}
