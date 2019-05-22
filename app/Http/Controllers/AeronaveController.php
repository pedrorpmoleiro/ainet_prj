<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAeronave;
use App\Http\Requests\UpdateAeronave;
use App\Aeronave;
use App\Movimento;
use App\User;

class AeronaveController extends Controller
{
    public function index()
    {
        $aeronaves = Aeronave::all();
        $title = 'Aeronaves';

        return view('aeronaves.list', compact('title', 'aeronaves'));
    }

    public function create()
    {
        $title = 'Inserir nova aeronave';
        $aeronave = new Aeronave();

        return view('aeronaves.add', compact('title', 'aeronave'));
    }

    public function store(StoreAeronave $request)
    {
        if ($request->has('cancel')) {
            return redirect()->action('AeronaveController@index');
        }

        $aeronave = $request->validated();

        Aeronave::create($aeronave);
        
        return redirect()->action('AeronaveController@index');
    }

    public function show($id)
    {
        // NAO IMPLEMENTAR
    }

    public function edit(Aeronave $aeronave)
    {
        $title = "Editar Aeronave";

        return view('aeronaves.edit', compact('title', 'aeronave'));
    }

    public function update(UpdateAeronave $request, Aeronave $aeronave)
    {
        if ($request->has('cancel')) {
            return redirect()->action('AeronaveController@index');
        }

        $aeronaveEdit = $request->validated();

        $aeronaveEdit['matricula'] = $aeronave->matricula;

        $aeronave->fill($aeronaveEdit);

        $aeronave->save();

        return redirect()->action('AeronaveController@index');
    }

    public function destroy(Aeronave $aeronave)
    {
        if (Movimento::where('aeronave', $aeronave->matricula)->count() == 0) {
            $aeronave->forceDelete();
        } else {
            $aeronave->delete();
        }

        return redirect()->action('AeronaveController@index');
    }

    public function pilotos(Aeronave $aeronave)
    {
        $title = "Pilotos Autorizados a voar a aeronave $aeronave->matricula";
        $pilotosAeronave = $aeronave->pilotos;
        $pilotosAeronaveIds = $aeronave->pilotos->pluck('id');
        $pilotos = User::where('tipo_socio', 'P');

        foreach ($pilotosAeronaveIds as $id) {
            $pilotos = $pilotos->where('id', '<>', $id);
        }

        $pilotos = $pilotos->get();

        return view('aeronaves.pilotos', compact('title', 'pilotosAeronave', 'pilotos', 'aeronave'));
    }

    public function addPiloto(Aeronave $aeronave, User $piloto)
    {

    }

    public function removePiloto(Aeronave $aeronave, User $piloto)
    {

    }
}
