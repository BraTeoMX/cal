<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaCliente extends Model
{
    use HasFactory;

    protected $table = 'categoria_clientes';
    // ... otras propiedades y métodos del modelo ... 
    public function categoriaEstilos()
    {
        return $this->hasMany(CategoriaEstilo::class, 'categoria_cliente_id');
    }
}
