<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovimento;
use App\Http\Requests\UpdateMovimento;
use App\Movimento;
use App\Aerodromo;
use App\User;
use App\Aeronave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovimentoController extends Controller
{
    public function index(Request $request)
    {
        $title="Movimentos";
        $movimentos=Movimento::orderBy('id');
        $query=$request->query();
        $filters=$query;

        foreach ($query as $name => $value) {
            $$name = $value;
        }
        if(isset($id)){
            $movimentos=$movimentos->where('id',$id);
        }
        if(isset($piloto)){
            $movimentos=$movimentos->where('piloto_id',$piloto);
        }
        if(isset($aeronave)){
            $movimentos=$movimentos->where('aeronave',$aeronave);
        }
        if(isset($data_inf)){
            if($filter_day=='posterior'){
                $movimentos=$movimentos->where('data','>',$data_inf);
            }
            else{
                if($filter_day=='anterior'){
                    $movimentos=$movimentos->where('data','<',$data_inf);
                }else{
                    if(isset($data_sup)){
                        $movimentos=$movimentos->where('data','between',$data_inf)->where('data',$data_sup);
                    }
                }
            }
        }
        if(isset($data_inf)){

        }
        $movimentos=$movimentos->paginate(24);
        return view('movimentos.list', compact('title', 'movimentos','filters'));

    }

    public function create()
    {
        $title='Inserir novo movimento';
        $movimento= new Movimento();
        $aerodromos= Aerodromo::all();

        return view('movimentos.add', compact('title', 'movimento','aerodromos'));
    }

    public function store(StoreMovimento $request)
    {
        if ($request->has('cancel')) {
            return redirect()->action('MovimentoController@index');
        }

        $movimento=$request->validated();

        $user=User::find($movimento['piloto_id']);

        $movimento['num_licenca_piloto']= $user['num_licenca'];
        $movimento['validade_licenca_piloto']=$user['validade_licenca'];
        $movimento['tipo_licenca_piloto']=$user['tipo_licenca'];
        $movimento['num_certificado_piloto']=$user['num_certificado'];
        $movimento['validade_certificado_piloto']= $user['validade_certificado'];
        $movimento['classe_certificado_piloto']=$user['classe_certificado'];
        $movimento['hora_descolagem']=$movimento['data'].' '.$movimento['hora_descolagem'];
        $movimento['hora_aterragem']=$movimento['data'].' '.$movimento['hora_aterragem'];
        $movimento['tempo_voo']=$movimento['conta_horas_fim']-$movimento['conta_horas_inicio'];
        $movimento['preco_voo']= $movimento['tempo_voo'] * Aeronave::find($movimento['aeronave'])->preco_hora;
        $movimento['confirmado']=0;
       
        Movimento::create($movimento);

        return redirect()->action('MovimentoController@index');
    }

    public function show($id)
    {
        // NAO E PARA IMPLEMENTAR
    }

    public function edit(Movimento $movimento)
    {
        $title = "Editar Movimento";
        
        return view('movimentos.edit', compact('title', 'movimento'));
    }

    public function update(UpdateMovimento $request, Movimento $movimento)
    {
        if ($request->has('cancel')) {
            return redirect()->action('MovimentoController@index');
        }
        
        $movimentoE=$request->validated();

        Movimento::fill($movimentoE);
        Movimento::save();

        return redirect()->action('MovimentoController@index');
    }

    public function destroy(Movimento $movimento)
    {
        $movimento->delete();

        return redirect()->action('MovimentoController@index');
    }

}
