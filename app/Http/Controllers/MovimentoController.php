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
        $title = "Movimentos";
        $movimentos = Movimento::orderBy('id');
        $query = $request->query();
        // $filters=$query;
        $filters = [
            'id' => '', 'piloto' => '', 'aeronave' => '', 'instrutor' => '', 'natureza' => '', 'confirmado' => '',
            'data_inf' => '', 'data_sup' => '', 'filter_day' => '', 'meus_movimentos' => ''
        ];

        foreach ($query as $name => $value) {
            $$name = $value;
        }

        if (isset($id)) {
            $filters['id'] = $id;
            $movimentos = $movimentos->where('id', $id);
        }
        if (isset($piloto)) {
            $filters['piloto'] = $piloto;
            $movimentos = $movimentos->where('piloto_id', $piloto);
        }
        if (isset($aeronave)) {
            $filters['aeronave'] = $aeronave;
            $movimentos = $movimentos->where('aeronave', $aeronave);
        }
        if (isset($instrutor)) {
            $filters['instrutor'] = $instrutor;
            $movimentos = $movimentos->where('instrutor_id', $instrutor);
        }
        if (isset($natureza)) {
            $filters['natureza'] = $natureza;
            if ($natureza != "Todos") $movimentos = $movimentos->where('natureza', $natureza);
        }
        if (isset($confirmado)) {
            $filters['confirmado'] = $confirmado;
            if ($confirmado != 'A') $movimentos = $movimentos->where('confirmado', $confirmado);
        }
        if (isset($filter_day)) {
            $filters['filter_day'] = $filter_day;
        } else {
            //VIENE DEL URL DIRECTO
            if (isset($data_inf)) {
                $filters['filter_day'] = 'posterior';
            } elseif (isset($data_sup)) {
                $filters['filter_day'] = 'anterior';
            }
        }
        if (isset($data_sup)) {
            if ($filters['filter_day'] == 'anterior') {
                $movimentos = $movimentos->where('data', '<=', $data_sup);
            }
        }
        if (isset($data_inf)) {
            if ($filters['filter_day'] == 'posterior') {
                $movimentos = $movimentos->where('data', '>=', $data_inf);
            }
        }
        if (isset($data_inf) && isset($data_sup)) {
            $filters['filter_day'] = 'duas_datas';
            $movimentos = $movimentos->where('data', '>=', $data_inf)->where('data', '<=', $data_sup);

        }
        if (isset($meus_movimentos)) {
            $filters['meus_movimentos'] = $meus_movimentos;
            if ($meus_movimentos != 'N') $movimentos = $movimentos->where('piloto_id', Auth::user()->id);
        }

        $movimentos = $movimentos->paginate(24);

        return view('movimentos.list', compact('title', 'movimentos', 'filters'));

    }

    public function create()
    {
        $title = 'Inserir novo movimento';
        $movimento = new Movimento();
        $aerodromos = Aerodromo::all();

        if (Auth::user()->direcao) {
            $aeronaves = Aeronave::all();
            $pilotos = User::where('tipo_socio', 'P')->get();
        } else {
            $aeronaves = Auth::user()->aeronaves;
            $pilotos = [Auth::user()];
        }

        $instrutores = User::where('instrutor', 1)->get();


        return view('movimentos.add', compact('title', 'movimento', 'aerodromos', 'pilotos', 'aeronaves', 'instrutores'));
    }

    public function store(StoreMovimento $request)
    {
        Session::forget('alert-warning');
        Session::forget('alert-danger');
        if ($request->has('cancel')) {
            return redirect()->action('MovimentoController@index');
        }
        $movimento = $request->validated();
        $user = Auth::user();

        $movimento['piloto_id'] = Auth::user()->id;
        $movimento['num_licenca_piloto'] = $user['num_licenca'];
        $movimento['validade_licenca_piloto'] = $user['validade_licenca'];
        $movimento['tipo_licenca_piloto'] = $user['tipo_licenca'];
        $movimento['num_certificado_piloto'] = $user['num_certificado'];
        $movimento['validade_certificado_piloto'] = $user['validade_certificado'];
        $movimento['classe_certificado_piloto'] = $user['classe_certificado'];
        $movimento['hora_descolagem'] = $movimento['data'] . ' ' . $movimento['hora_descolagem'];
        $movimento['hora_aterragem'] = $movimento['data'] . ' ' . $movimento['hora_aterragem'];

        if ($movimento['natureza'] == 'I') {
            $instrutor = User::findOrFail($movimento['instrutor_id']);
            $movimento['num_licenca_instrutor'] = $instrutor->num_licenca;
            $movimento['validade_licenca_instrutor'] = $instrutor->validade_licenca;
            $movimento['tipo_licenca_instrutor'] = $instrutor->tipo_licenca;
            $movimento['num_certificado_instrutor'] = $instrutor->num_certificado;
            $movimento['validade_certificado_instrutor'] = $instrutor->validade_certificado;
            $movimento['classe_certificado_instrutor'] = $instrutor->classe_certificado;
        } else {
            $movimento['instrutor_id'] = null;
            $movimento['tipo_instrucao']=null;
        }
        //CONTA HORAS US19
        //CONTA HORAS US19
        $ultMovimento = Movimento::where('aeronave', $movimento['aeronave'])->orderBy('conta_horas_fim', 'desc')->first();
        $resolver = $request->input('resolver');
        if (is_null($resolver)) {
            if ($movimento['conta_horas_inicio'] > $ultMovimento->conta_horas_fim) {
                //SOBREPOSICAO
                Session::flash('alert-warning', 'Movimento com conflito de um buraco!');
                return redirect()->action('MovimentoController@create')->withInput();
            } elseif ($movimento['conta_horas_inicio'] < $ultMovimento->conta_horas_fim) {
                Session::flash('alert-danger', 'Movimento com conflito de sobreposicao!');
                return redirect()->action('MovimentoController@create')->withInput();
            }
        } else {
            if ($movimento['conta_horas_inicio'] > $ultMovimento->conta_horas_fim) {
                $movimento['tipo_conflito'] = 'B';
            } elseif ($movimento['conta_horas_inicio'] < $ultMovimento->conta_horas_fim) {
                $movimento['tipo_conflito'] = 'S';
            }
        }
        $movimento['confirmado'] = 0;
        //US18
        /*$movimento['tempo_voo'] = (($movimento['conta_horas_fim'] - $movimento['conta_horas_inicio']) / 10) * 60;
        $movimento['preco_voo'] = ($movimento['tempo_voo'] / 60) * Aeronave::find($movimento['aeronave'])->preco_hora;
        $movimento['confirmado'] = 0;
        */
        $aeronave_valores=DB::table('aeronaves_valores')->where('matricula',$movimento['aeronave'])->get();
        $conta_horas_resta=(($movimento['conta_horas_fim'] - $movimento['conta_horas_inicio']));
        if($conta_horas_resta<=10){
            $aeronave_valores=$aeronave_valores->where('unidade_conta_horas',$conta_horas_resta);
            $movimento['tempo_voo']=$aeronave_valores->first()->minutos;
            $movimento['preco_voo']=$aeronave_valores->first()->preco;
        }else{
            $multiplo= (int) $conta_horas_resta/10;
            $multiplo=round($multiplo,0,PHP_ROUND_HALF_DOWN);
            $resto=$conta_horas_resta%10;
            $tempo=$aeronave_valores->where('unidade_conta_horas',10)->first()->minutos*$multiplo;
            $preco=$aeronave_valores->where('unidade_conta_horas',10)->first()->preco*$multiplo;
            $tempo+=$aeronave_valores->where('unidade_conta_horas',$resto)->first()->minutos;
            $preco+=$aeronave_valores->where('unidade_conta_horas',$resto)->first()->preco;
            $movimento['tempo_voo']=$tempo;
            $movimento['preco_voo']=$preco;
        }
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
        $aerodromos = Aerodromo::all();

        if (Auth::user()->direcao) {
            $aeronaves = Aeronave::all();
            $pilotos = User::where('tipo_socio', 'P')->get();
        } else {
            $aeronaves = Auth::user()->aeronaves;
            $pilotos = [Auth::user()];
        }

        $instrutores = User::where('instrutor', 1)->get();


        return view('movimentos.edit', compact('title', 'movimento', 'aeronaves', 'pilotos', 'aerodromos', 'instrutores'));
    }

    public function update(UpdateMovimento $request, Movimento $movimento)
    {
        $confirmar=$request->input('confirmar');
        if(isset($confirmar)){
            $movimento->confirmado=1;
            $movimento->save();
            return redirect()->action('MovimentoController@index');
        }
        Session::forget('alert-warning');
        Session::forget('alert-danger');
        if ($request->has('cancel')) {
            return redirect()->action('MovimentoController@index');
        }

        $movimentoE = $request->validated();

        $movimento->fill($movimentoE);
        $movimento['hora_descolagem'] = $movimento['data'] . ' ' . $movimento['hora_descolagem'];
        $movimento['hora_aterragem'] = $movimento['data'] . ' ' . $movimento['hora_aterragem'];

        if ($movimento['natureza'] == 'I') {
            $instrutor = User::findOrFail($movimento['instrutor_id']);
            $movimento['num_licenca_instrutor'] = $instrutor->num_licenca;
            $movimento['validade_licenca_instrutor'] = $instrutor->validade_licenca;
            $movimento['tipo_licenca_instrutor'] = $instrutor->tipo_licenca;
            $movimento['num_certificado_instrutor'] = $instrutor->num_certificado;
            $movimento['validade_certificado_instrutor'] = $instrutor->validade_certificado;
            $movimento['classe_certificado_instrutor'] = $instrutor->classe_certificado;
        } else {
            $movimento['instrutor_id'] = null;
            $movimento['num_licenca_instrutor'] = null;
            $movimento['validade_licenca_instrutor'] = null;
            $movimento['tipo_licenca_instrutor'] = null;
            $movimento['num_certificado_instrutor'] = null;
            $movimento['validade_certificado_instrutor'] = null;
            $movimento['classe_certificado_instrutor'] = null;
            $movimento['tipo_instrucao']=null;
        }

        $ultMovimento = Movimento::where('aeronave', $movimento['aeronave'])->orderBy('conta_horas_fim', 'desc')->first();
        $resolver = $request->input('resolver');

        if (is_null($resolver)) {
            if ($movimento['conta_horas_inicio'] > $ultMovimento->conta_horas_fim) {
                //SOBREPOSICAO
                Session::flash('alert-warning', 'Movimento com conflito de um buraco!');
                return redirect()->action('MovimentoController@edit', ['movimento'=>$movimento->id])->withInput();
                /*$movimentoAux=new Movimento();
                $movimentoAux->fill($movimento);
                return $this->edit($movimentoAux);
                */
            } elseif ($movimento['conta_horas_inicio'] < $ultMovimento->conta_horas_fim) {
                Session::flash('alert-danger', 'Movimento com conflito de sobreposicao!');
                return redirect()->action('MovimentoController@edit', ['movimento'=>$movimento->id])->withInput();
               /* $movimentoAux=new Movimento();
                $movimentoAux->fill($movimento);
                return $this->edit($movimentoAux);
               */
            }
        } else {
            if ($movimento['conta_horas_inicio'] > $ultMovimento->conta_horas_fim) {
                $movimento['tipo_conflito'] = 'B';
            } elseif ($movimento['conta_horas_inicio'] < $ultMovimento->conta_horas_fim) {
                $movimento['tipo_conflito'] = 'S';
            }
        }
        $aeronave_valores=DB::table('aeronaves_valores')->where('matricula',$movimento['aeronave'])->get();
        $conta_horas_resta=(($movimento['conta_horas_fim'] - $movimento['conta_horas_inicio']));
        if($conta_horas_resta<=10){
            $aeronave_valores=$aeronave_valores->where('unidade_conta_horas',$conta_horas_resta);
            $movimento['tempo_voo']=$aeronave_valores->first()->minutos;
            $movimento['preco_voo']=$aeronave_valores->first()->preco;
        }else{
            $multiplo= (int) $conta_horas_resta/10;
            $multiplo=round($multiplo,0,PHP_ROUND_HALF_DOWN);
            $resto=$conta_horas_resta%10;
            $tempo=$aeronave_valores->where('unidade_conta_horas',10)->first()->minutos*$multiplo;
            $preco=$aeronave_valores->where('unidade_conta_horas',10)->first()->preco*$multiplo;
            $tempo+=$aeronave_valores->where('unidade_conta_horas',$resto)->first()->minutos;
            $preco+=$aeronave_valores->where('unidade_conta_horas',$resto)->first()->preco;
            $movimento['tempo_voo']=$tempo;
            $movimento['preco_voo']=$preco;
        }
       //dd($movimento);
        $movimento['confirmado'] = 0;
        $movimento->save();
        return redirect()->action('MovimentoController@index');
    }

    public function destroy(Movimento $movimento)
    {
        $movimento->delete();

        return redirect()->action('MovimentoController@index');
    }

}
