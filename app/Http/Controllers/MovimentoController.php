<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movimento;
use App\Aerodromo;
use App\User;
use App\Aeronave;

class MovimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movimentos = Movimento::paginate(24);
        $title = "Movimentos";

        return view('movimentos.list', compact('title', 'movimentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='Inserir novo movimento';
        $movimento= new Movimento();
        $aerodromos= Aerodromo::all();
        return view('movimentos.add', compact('title', 'movimento','aerodromos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('cancel')) {
            return redirect()->action('MovimentoController@index');
        }
      $movimento=$request->validate(
        ['data'=>'required|date',
        'aeronave'=>'required|exists:aeronaves,matricula',
        'hora_descolagem'=>'required',
        'hora_aterragem'=>'required',
        'num_diario'=>'required',
        'num_servico'=>'required',
        'piloto_id'=>'required|exists:users,id',
    //    'natureza'=>'required',
        'num_aterragens'=>'required',
        'num_descolagens'=>'required',
        'num_pessoas'=>'required',
        'conta_horas_inicio'=>'required',
        'conta_horas_fim'=>'required',
     //   'modo_pagamento'=>'required',
        'num_recibo'=>'required',
        'aerodromo_partida'=>'required',
        'aerodromo_chegada'=>'required'
      ],
        [
        'data.required'=>'A data é requerida',
        'data.date'=>'Data inválida',
        'aeronave.required'=>'A aeronave é requerida',
        'aeronave.exists'=>'A aeronave não existe',
        'hora_descolagem.required'=>'A hora decolagem é requerida',
        'hora_aterragem.required'=>'A hora aterragem é requerida',
        'num_diario.required'=>' Número de diario é requerido',
        'num_servico.required'=>'Número de servico é requerido',
        'piloto_id.required'=>' O número de pilotoé requerido',
        'piloto_id.exists'=>'O piloto não existe',
        //'natureza.required'=>'Naturaeza do voo é requerida',
        'num_aterragens.required'=>'Número de aterragens é requerido',
        'num_descolagens.required'=>'Número descolagens é requerido',
        'num_pessoas.required'=>'Número de pessoas é requerido ',
        'conta_horas_inicio.required'=>'As horas de inicio é requerida',
        'conta_horas_fim.required'=>'As horas de fim é requerida',
     //   'modo_pagamento.required'=>'O modo do pagamento é requerido',
        'num_recibo.required'=>'Número de recibo é requerido',
        'aerodromo_partida.required'=>'O aerodromo é requerido',
        'aerodromo_chegada.required'=>'O aerodromo é requerido'
        ]);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // NAO E PARA IMPLEMENTAR
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Movimento $movimento)
    {
        $title = "Editar Movimento";
        
        return view('movimentos.edit', compact('title', 'movimento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movimento $movimento)
    {
        if ($request->has('cancel')) {
            return redirect()->action('MovimentoController@index');
        }
        
        $movimentoE=$request->validate(
            ['data'=>'required|data',
            'aeronave'=>'required',
            'hora_descolagem'=>'required',
            'hora_aterragem'=>'required',
            'num_diario'=>'required',
            'num_servico'=>'required',
            'piloto_id'=>'required',
            'natureza'=>'required',
            'aerodromo_partida'=>'required',
            'aerodromo_chegada'=>'required',
            'num_aterragens'=>'required',
            'num_descolagens'=>'required',
            'num_pessoas'=>'required',
            'conta_horas_inicio'=>'required',
            'conta_horas_fim'=>'required',
    //        'modo_pagamento'=>'required',
            'num_recibo'=>'required',
    //        'tipo_instrucao'=>'required',
            'instrutor_id'=>'required'
          ],
            [
            'data.required'=>'A data é requerida',
            'data.data'=>'Data inválida',
            'aeronave.required'=>'A aeronave é requerida',
            'hora_descolagem.required'=>'A hora decolagem é requerida',
            'hora_aterragem.required'=>'A hora aterragem é requerida',
            'num_diario.required'=>' Número de diario é requerido',
            'num_servico.required'=>'Número de servico é requerido',
            'piloto_id.required'=>' O número de pilotoé requerido',
            //'natureza.required'=>'Naturaeza do voo é requerida',
            'aerodromo_partida.required'=>'O aerodromo de partida é requerido',
            'aerodromo_chegada.required'=>'O aerodromo de chegada é requerido',
            'num_aterragens.required'=>'Número de aterragens é requerido',
            'num_descolagens.required'=>'Número descolagens é requerido',
            'num_pessoas.required'=>'Número de pessoas é requerido ',
            'conta_horas_inicio.required'=>'As horas de inicio é requerida',
            'conta_horas_fim.required'=>'As horas de fim é requerida',
     //       'modo_pagamento.required'=>'O modo do pagamento é requerido',
            'num_recibo.required'=>'Número de recibo é requerido',
    //        'tipo_instrucao.required'=>'Tipo instrucao é requerido',
            'instrutor_id.required'=>'Número do instrutor é requerido'
           
            ]);

            Movimento::fill($movimentoE);
            Movimento::save();
            return redirect()->action('MovimentoController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movimento $movimento)
    {
        $movimento->delete();
        return redirect()->action('MovimentoController@index');
    }
}
