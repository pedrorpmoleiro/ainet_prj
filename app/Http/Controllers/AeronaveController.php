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
            'preco_hora'=> 'required|numeric'      
        ], [
            'matricula.required'=>'A matricula deve ser preenchida'
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
       // TODO
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
