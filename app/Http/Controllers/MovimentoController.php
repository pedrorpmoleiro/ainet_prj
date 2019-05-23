<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovimento;
use App\Http\Requests\UpdateMovimento;
use App\Movimento;
use App\Aerodromo;
use App\User;
use App\Aeronave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MovimentoController extends Controller
{

    public function index(Request $request)
    {
        $title="Movimentos";
        $movimentos=Movimento::orderBy('id');
        $query=$request->query();
        // $filters=$query;
        $filters=[
            'id'=>'','piloto'=>'','aeronave'=>'','instrutor'=>'','natureza'=>'','confirmado'=>'',
            'data_inf'=>'','data_sup'=>'','filter_day'=>'','meus_movimentos'=>''
        ];

        foreach ($query as $name => $value) {
            $$name = $value;
        }

        if(isset($id)) {
            $filters['id']=$id;
            $movimentos=$movimentos->where('id',$id);
        }
        if(isset($piloto)) {
            $filters['piloto']=$piloto;
            $movimentos=$movimentos->where('piloto_id',$piloto);
        }
        if(isset($aeronave)) {
            $filters['aeronave']=$aeronave;
            $movimentos=$movimentos->where('aeronave',$aeronave);
        }
        if(isset($instrutor)) {
            $filters['instrutor']=$instrutor;
            $movimentos=$movimentos->where('instrutor_id',$instrutor);
        }
        if(isset($natureza)) {
            $filters['natureza']=$natureza;
            if($natureza!="Todos")$movimentos=$movimentos->where('natureza',$natureza);
        }
        if(isset($confirmado)) {
            $filters['confirmado']=$confirmado;
            if($confirmado!='A')$movimentos=$movimentos->where('confirmado',$confirmado);
        }
        if(isset($data_inf)) {
            $filters['filter_day']=$filter_day;
            $filters['data_inf']=$data_inf;
            if($filter_day=='posterior') {
                $movimentos=$movimentos->where('data','>',$data_inf);
            } else {
                if($filter_day=='anterior') {
                    $movimentos=$movimentos->where('data','<',$data_inf);
                } else {
                    if($filter_day=='data') {
                        $movimentos=$movimentos->where('data', $data_inf);
                    } else {
                        if(isset($data_sup)) {
                            $filters['data_sup']=$data_sup;
                            $movimentos=$movimentos->where('data','>',$data_inf)->where('data','<',$data_sup);
                        }
                    }
                }
            }
        }
        if(isset($meus_movimentos)){
            $filters['meus_movimentos']=$meus_movimentos;
            if($meus_movimentos=='S'){
                $movimentos=$movimentos->where('piloto_id',Auth::user()->id);
            }
        }

        $movimentos=$movimentos->paginate(24);

        return view('movimentos.list', compact('title', 'movimentos','filters'));

    }

    public function create()
    {
        $title='Inserir novo movimento';
        $movimento= new Movimento();
        $aerodromos= Aerodromo::all();
        $aeronaves=Auth::user()->aeronaves;
        $instrutores=User::where('instrutor',1)->get();


        return view('movimentos.add', compact('title', 'movimento','aerodromos','aeronaves','instrutores'));
    }

    public function store(StoreMovimento $request)
    {
        Session::forget('alert-warning');
        Session::forget('alert-danger');
        if ($request->has('cancel')) {
            return redirect()->action('MovimentoController@index');
        }
        $movimento=$request->validated();
        $user=Auth::user();

        $movimento['piloto_id']=Auth::user()->id;
        $movimento['num_licenca_piloto']= $user['num_licenca'];
        $movimento['validade_licenca_piloto']=$user['validade_licenca'];
        $movimento['tipo_licenca_piloto']=$user['tipo_licenca'];
        $movimento['num_certificado_piloto']=$user['num_certificado'];
        $movimento['validade_certificado_piloto']= $user['validade_certificado'];
        $movimento['classe_certificado_piloto']=$user['classe_certificado'];
        $movimento['hora_descolagem']=$movimento['data'].' '.$movimento['hora_descolagem'];
        $movimento['hora_aterragem']=$movimento['data'].' '.$movimento['hora_aterragem'];
        if($movimento['natureza']=='I'){
            $instrutor=User::find($movimento['instrutor_id']);
            $movimento['num_licenca_instrutor']=$instrutor['num_licenca'];
            $movimento['validade_licenca_instrutor']=$instrutor['validade_licenca'];
            $movimento['tipo_licenca_instrutor']=$instrutor['tipo_licenca'];
            $movimento['num_certificado_instrutor']=$instrutor['num_certificado'];
            $movimento['validade_certificado_instrutor']= $instrutor['validade_certificado'];
            $movimento['classe_certificado_instrutor']=$instrutor['classe_certificado'];
        }else{
            $movimento['instrutor_id']=null;
        }
        //CONTA HORAS US19
        //CONTA HORAS US19
        $ultMovimento=Movimento::where('aeronave',$movimento['aeronave'])->orderBy('conta_horas_fim','desc')->first();
        $resolver=$request->input('resolver');
        if(is_null($resolver)){
            if($movimento['conta_horas_inicio']>$ultMovimento->conta_horas_fim ){
                //SOBREPOSICAO
                Session::flash('alert-warning', 'Movimento com conflito de um buraco!');
                $movimentoR=$movimento;
                $movimento=new Movimento();
                $movimento->fill($movimentoR);
                $title='Inserir novo movimento';
                $aerodromos= Aerodromo::all();
                $aeronaves=Auth::user()->aeronaves;
                $instrutores=User::where('instrutor',1)->get();
                //   dd($movimento);
                return view('movimentos.add', compact('title', 'movimento','aerodromos','aeronaves','instrutores'));
            }
            elseif($movimento['conta_horas_inicio']<$ultMovimento->conta_horas_fim){
                Session::flash('alert-danger', 'Movimento com conflito de sobreposicao!');
                $movimentoR=$movimento;
                $movimento=new Movimento();
                $movimento->fill($movimentoR);
                $title='Inserir novo movimento';
                $aerodromos= Aerodromo::all();
                $aeronaves=Auth::user()->aeronaves;
                $instrutores=User::where('instrutor',1)->get();
                //   dd($movimento);
                return view('movimentos.add', compact('title', 'movimento','aerodromos','aeronaves','instrutores'));
            }
        }else{
            if($movimento['conta_horas_inicio']>$ultMovimento->conta_horas_fim ){
                $movimento['tipo_conflito']='B';
            }elseif ($movimento['conta_horas_inicio']<$ultMovimento->conta_horas_fim){
                $movimento['tipo_conflito']='S';
            }
        }
        //US18
        $movimento['tempo_voo'] = (($movimento['conta_horas_fim'] - $movimento['conta_horas_inicio'])/10)*60;
        $movimento['preco_voo'] = ($movimento['tempo_voo']/60) * Aeronave::find($movimento['aeronave'])->preco_hora;
        $movimento['confirmado']=0;
        // dd($movimento);
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
        $aerodromos= Aerodromo::all();
        $aeronaves=Auth::user()->aeronaves;
        $instrutores=User::where('instrutor',1)->get();
        //var_dump($instrutores);
        return view('movimentos.edit', compact('title', 'movimento','aeronaves','aerodromos','instrutores'));
    }
    public function update(UpdateMovimento $request, Movimento $movimento)
    {
        if ($request->has('cancel')) {
            return redirect()->action('MovimentoController@index');
        }

        $movimentoE=$request->validated();
        $movimento->fill($movimentoE);
        $movimento['hora_descolagem']=$movimento['data'].' '.$movimento['hora_descolagem'];
        $movimento['hora_aterragem']=$movimento['data'].' '.$movimento['hora_aterragem'];
        if($movimento['natureza']=='I'){
            $instrutor=User::find($movimento['instrutor_id']);
            $movimento['num_licenca_instrutor']=$instrutor['num_licenca'];
            $movimento['validade_licenca_instrutor']=$instrutor['validade_licenca'];
            $movimento['tipo_licenca_instrutor']=$instrutor['tipo_licenca'];
            $movimento['num_certificado_instrutor']=$instrutor['num_certificado'];
            $movimento['validade_certificado_instrutor']= $instrutor['validade_certificado'];
            $movimento['classe_certificado_instrutor']=$instrutor['classe_certificado'];
        }else{
            $movimento['instrutor_id']=null;
            $movimento['num_licenca_instrutor']=null;
            $movimento['validade_licenca_instrutor']=null;
            $movimento['tipo_licenca_instrutor']=null;
            $movimento['num_certificado_instrutor']=null;
            $movimento['validade_certificado_instrutor']= null;
            $movimento['classe_certificado_instrutor']=null;
        }
        $ultMovimento=Movimento::where('aeronave',$movimento['aeronave'])->orderBy('conta_horas_fim','desc')->first();
        $resolver=$request->input('resolver');
        if(is_null($resolver)){
            if($movimento['conta_horas_inicio']>$ultMovimento->conta_horas_fim ){
                //SOBREPOSICAO
                Session::flash('alert-warning', 'Movimento com conflito de um buraco!');
                $title='Inserir novo movimento';
                $aerodromos= Aerodromo::all();
                $aeronaves=Auth::user()->aeronaves;
                $instrutores=User::where('instrutor',1)->get();
                //   dd($movimento);
                return view('movimentos.add', compact('title', 'movimento','aerodromos','aeronaves','instrutores'));
            }
            elseif($movimento['conta_horas_inicio']<$ultMovimento->conta_horas_fim){
                Session::flash('alert-danger', 'Movimento com conflito de sobreposicao!');
                $title='Inserir novo movimento';
                $aerodromos= Aerodromo::all();
                $aeronaves=Auth::user()->aeronaves;
                $instrutores=User::where('instrutor',1)->get();
                //   dd($movimento);
                return view('movimentos.add', compact('title', 'movimento','aerodromos','aeronaves','instrutores'));
            }
        }else{
            if($movimento['conta_horas_inicio']>$ultMovimento->conta_horas_fim ){
                $movimento['tipo_conflito']='B';
            }elseif ($movimento['conta_horas_inicio']<$ultMovimento->conta_horas_fim){
                $movimento['tipo_conflito']='S';
            }
        }
        $movimento['tempo_voo'] = (($movimento['conta_horas_fim'] - $movimento['conta_horas_inicio'])/10)*60;
        $movimento['preco_voo'] = ($movimento['tempo_voo']/60) * Aeronave::find($movimento['aeronave'])->preco_hora;
        $movimento['confirmado']=0;
        $movimento->save();
        return redirect()->action('MovimentoController@index');
    }

    public function destroy(Movimento $movimento)
    {
        $movimento->delete();

        return redirect()->action('MovimentoController@index');
    }

}
