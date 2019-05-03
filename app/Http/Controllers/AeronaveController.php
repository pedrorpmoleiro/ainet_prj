<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aeronave;

class AeronaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aeronaves = Aeronave::all();
        $title = 'Aeronaves';

        return view('aeronaves.list', compact('title', 'aeronaves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Inserir nova aeronave';
        $aeronave = new Aeronave();

        return view('aeronaves.add', compact('title', 'aeronave'));
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
            return redirect()->action('AeronaveController@index');
        }
        
        $aeronave = $request->validate([
            'matricula'=>'required|unique',
            'marca'=> 'required',
            'num_lugares' => 'integer|required',	
            'conta_horas'=> 'integer|required',	
            'preco_hora'=> 'required|numeric',
            'modelo' => 'required'      
        ], [
            'matricula.required'=>'A matricula deve ser preenchida',
            'marca.required'=> ' A marca deve ser preenchida',
            'num_lugares.required' => 'Os lugares deve ser preenchido',	
            'conta_horas.required'=> 'As horas deve ser preenchido ',	
            'preco_hora.required'=> 'O preco deve ser preenchido',
            'modelo.required' => 'O modelo deve ser preenchido',
            'num_lugares.integer' => 'Deve ser um numero inteiro',
            'conta_horas.integer'=> 'Deve ser um numero inteiro',  
        ]);

        Aeronave::create($aeronave);
        
        return redirect()->action('AeronaveController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // NAO IMPLEMENTAR
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Aeronave $aeronave)
    {
        $title = "Editar Aeronave";

        return view('aeronaves.edit', compact('title', 'aeronave'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aeronave $aeronave)
    {
        if ($request->has('cancel')) {
            return redirect()->action('AeronaveController@index');
        }

        $aeronaveEdit = validateInput($request);

        $aeronave->fill($aeronaveEdit);
        $aeronave->save();

        return redirect()->action('AeronaveController@index');
    }

    function validateInput($request) {
        return $request->validate([

        ],[

        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aeronave $aeronave)
    {
        $aeronave->delete();

        return redirect()->action('AeronaveController@index');
    }
}
