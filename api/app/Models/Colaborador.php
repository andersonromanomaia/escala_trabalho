<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    use HasFactory;

    public $table = "Colaboradores";
    
    protected $fillable = [
        'matricula',
        'nome',
        'filial_codigo',
        'ciclo',
        'ultima_folga',
    ];
}
