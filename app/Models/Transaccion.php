<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $table = 'transacciones';

    protected $fillable = ['id_cuenta', 'tipo', 'monto', 'fecha'];

    public function cuenta()
    {
        return $this->belongsTo(Cuenta::class, 'id_cuenta');
    }
}