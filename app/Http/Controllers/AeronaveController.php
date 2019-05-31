<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAeronave;
use App\Http\Requests\UpdateAeronave;
use App\Aeronave;
use App\Movimento;
use App\User;
use Illuminate\Support\Facades\DB;

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

        $minutos = [5, 10, 20, 25, 30, 35, 40, 50, 55, 60];
        $precos = ['', '', '', '', '', '', '', '', '', ''];

        return view('aeronaves.add', compact('title', 'aeronave', 'minutos', 'precos'));
    }

    public function store(StoreAeronave $request)
    {
        if ($request->has('cancel')) {
            return redirect()->action('AeronaveController@index');
        }

        $aeronave = $request->validated();

        Aeronave::create($aeronave);

        $insert = [];
        $precos = $aeronave['precos'];
        $tempos = $aeronave['tempos'];

        for ($i = 0; $i < 10; $i++) {
            $insert[] = ['matricula'=>$aeronave['matricula'], 'unidade_conta_horas'=>($i + 1), 'minutos'=>$tempos[$i], 'preco'=>$precos[$i]];
        }

        DB::table('aeronaves_valores')->insert($insert);
        
        return redirect()->action('AeronaveController@index');
    }

    public function show($id)
    {
        // NAO IMPLEMENTAR
    }

    public function edit(Aeronave $aeronave)
    {
        $title = "Editar Aeronave";

        $minutosCol = DB::table('aeronaves_valores')->where('matricula', $aeronave->matricula)->select(['minutos'])->get();
        $precosCol = DB::table('aeronaves_valores')->where('matricula', $aeronave->matricula)->select(['preco'])->get();

        $minutos = [];
        $precos = [];

        for ($i = 0; $i < 10; $i++) {
            $minutos[] = $minutosCol->get($i)->minutos;
            $precos[] = $precosCol->get($i)->preco;
        }

        return view('aeronaves.edit', compact('title', 'aeronave', 'minutos', 'precos'));
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

        $precos = $aeronaveEdit['precos'];
        $tempos = $aeronaveEdit['tempos'];

        for ($i = 0; $i < 10; $i++) {
            DB::table('aeronaves_valores')->where('matricula', $aeronave->matricula)
                ->where('unidade_conta_horas', ($i + 1))->update(['minutos'=>$tempos[$i], 'preco'=>$precos[$i]]);
        }

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
        $pilotos = User::where('tipo_socio', 'P')->whereNotIn('id', $pilotosAeronaveIds)->get();

        return view('aeronaves.pilotos', compact('title', 'pilotosAeronave', 'pilotos', 'aeronave'));
    }

    public function addPiloto(Aeronave $aeronave, User $piloto)
    {
        DB::table('aeronaves_pilotos')->insert([
           'matricula'=>$aeronave->matricula,
           'piloto_id'=>$piloto->id
        ]);

        return redirect()->back();
    }

    public function removePiloto(Aeronave $aeronave, User $piloto)
    {
        DB::table('aeronaves_pilotos')->where('matricula', $aeronave->matricula)
            ->where('piloto_id', $piloto->id)->delete();

        return redirect()->back();
    }
}
