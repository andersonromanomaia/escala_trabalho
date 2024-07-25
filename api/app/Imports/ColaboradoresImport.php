<?php

namespace App\Imports;

use App\Models\Colaborador;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ColaboradoresImport implements ToModel, WithHeadingRow
{
    public $table = "Colaboradores";

    protected $fillable = [
        'matricula',
        'nome',
        'filial_codigo',
        'ciclo',
        'ultima_folga',
    ];

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Colaborador([
           'matricula' => $row['matricula'],
           'nome' => $row['nome'], 
           'filial_codigo' => $row['filial_codigo'], 
           'ciclo' => $row['ciclo'], 
           'ultima_folga' => $row['ultima_folga'], 
        ]);
    }
}
