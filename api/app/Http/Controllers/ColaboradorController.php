<?php

namespace App\Http\Controllers;

use App\Imports\ColaboradoresImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Colaborador;
use App\Http\Requests\StoreColaboradorRequest;
use App\Http\Requests\UpdateColaboradorRequest;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColaboradorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Colaborador $colaborador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColaboradorRequest $request, Colaborador $colaborador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Colaborador $colaborador)
    {
        //
    }

    public function import(Request $request) 
    {
        $file = $request->file('arquivo');
        Excel::import(new ColaboradoresImport, $file);
        
        return response()->json($request->all());
    }

    
    public function listarFiliais(){
        $codigo_filial = Colaborador::distinct()->orderBy('filial_codigo', 'ASC')->get(['filial_codigo']);
 
        return ['data' => $codigo_filial            
        ];
     }
 
    
    public function retornoFolgaMes(Request $request) {

        $dados = Colaborador::where('filial_codigo',$request->filial)->orderBy('nome', 'ASC')->get();

        $result = [];
        $folgas_mes = [];
 
        foreach ($dados as $item) {
            $year = substr($item->ultima_folga,6,4);
            $month = substr($item->ultima_folga,3,2);
            $day = substr($item->ultima_folga,0,2);
            $pmes = 9;
            $pano = 2024;
            $ciclo = $item->ciclo;
            $folgas_mes = null;


            $folgas_mes = $this->CalculaDiasFolgaDomingo($day,$month,$year,$request->input('mes'),$request->input('ano'),$ciclo);

            $result[] = [
                "matricula" => $item->matricula,
                "nome" => $item->nome,
                "ciclo" => $item->ciclo,
                "ultima_folga" => $item->ultima_folga,
                "folgas_mes" => $folgas_mes,
            ];
        }
        
        return $result;

    }

    public function CalculaDiasFolgaDomingo($day,$month,$year,$pmonth,$pyear,$ciclo){

        $folgas = [];

        // Início - Saber o dia da última Folga no calendário Juliano
        $day1_semana = date("w", strtotime($year."-".$month."-".$day));
        $dia_ini = date("Y-m-d",strtotime($year."-".$month."-".$day));

        if ($day1_semana==0){
            $dia_inicial = $dia_ini;
        }
        else{
            $diff = (7-$day1_semana);
            $dia_inicial = date("Y-m-d",strtotime("+{$diff} days",strtotime($dia_ini)));
        }

        $dia_juliano = date("d", strtotime($dia_inicial));
        $mes_juliano = date("m", strtotime($dia_inicial));
        $ano_juliano = date("Y", strtotime($dia_inicial));
        $diaFolga_juliano = juliantojd($mes_juliano, $dia_juliano, $ano_juliano);
        // Fim - Saber o dia da última Folga no calendário Juliano

        // Início - Saber o primeiro domingo do mês        
        $day1_mes = date("w", strtotime($pyear."-".$pmonth."-1"));
        $dia_ini_mes = date("Y-m-d",strtotime($pyear."-".$pmonth."-1"));
        $dia_fim_mes = date("Y-m-t",strtotime($pyear."-".$pmonth."-1"));
        
        if ($day1_mes==0){
            $dia_inicial_mes = $dia_ini_mes;
        }
        else{
            $diff = (7-$day1_mes);
            $dia_inicial_mes = date("Y-m-d",strtotime("+{$diff} days",strtotime($dia_ini_mes)));
        }
        
        
        // Fim primeiro domingo do mês
        
        $dia_juliano = date("d", strtotime($dia_inicial_mes));
        $mes_juliano = date("m", strtotime($dia_inicial_mes));
        $ano_juliano = date("Y", strtotime($dia_inicial_mes));
        
        $qtde_dias_ciclo = 7+($ciclo*7);

        $dia_proxima_folga = $dia_ini;

        while ($dia_proxima_folga <= $dia_ini_mes){
            $dia_proxima_folga = date("Y-m-d",strtotime("+{$qtde_dias_ciclo} days",strtotime($dia_proxima_folga)));
        }

        
        $count=0;
        while (($dia_proxima_folga>=$dia_ini_mes) && ($dia_proxima_folga<=$dia_fim_mes)){
            if ($dia_proxima_folga<=$dia_fim_mes){
                $folgas[] = ["dia" => date("d",strtotime($dia_proxima_folga))];
                $count++;
            }
            $dia_proxima_folga = date("Y-m-d",strtotime("+{$qtde_dias_ciclo} days",strtotime($dia_proxima_folga)));
        }

        // if ($count==0){
        //     $folgas[] = ["dia" => ''];
        // }

        return $folgas;
    }
}
