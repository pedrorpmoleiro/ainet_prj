<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePassword;
use App\Http\Requests\StoreSocio;
use App\Http\Requests\UpdateSocio;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $socios=User::orderBy('id');
        $query=$request->query();
        $title = 'Sócios';
        $filters=[
            'num_socio'=>'','nome_informal'=>'','email'=>'','tipo'=>'',
            'direcao'=>'','quotas_pagas'=>'','ativo'=>''
        ];

        foreach ($query as $name => $value) {
            $$name = $value;
        }

        if(isset($num_socio)) {
            $filters['num_socio']=$num_socio;
            $socios=$socios->where('num_socio',$num_socio);
        }
        if(isset($nome_informal)) {
            $filters['nome_informal']=$nome_informal;
            $socios=$socios->where('nome_informal', 'like', '%'.$nome_informal.'%');
        }
        if(isset($email)) {
            $filters['email']=$email;
            $socios=$socios->where('email', 'like', '%'.$email.'%');
        }
        if(isset($tipo)) {
            $filters['tipo']=$tipo;
            if($tipo!='T'){
                $socios=$socios->where('tipo_socio',$tipo);
            }
        }
        if(isset($direcao)) {
            $filters['direcao']=$direcao;
            if($direcao!='A'){
                $socios=$socios->where('direcao',$direcao);
            }
        }
        if(isset($quotas_pagas)) {
            $filters['quotas_pagas']=$quotas_pagas;
            $socios=$socios->where('quotas_pagas',$quotas_pagas);
        }
<<<<<<< Updated upstream
        if (Auth::user()->direcao == 1) {
            if(isset($ativo)) {
                $filters['ativo']=$ativo;
                $socios=$socios->where('ativo',$ativo);
            }
        } else {
            $socios = $socios->where('ativo', 1);
=======
        if(isset($ativo)) {
            $filters['ativo']=$ativo;
            if($ativo!='A') $socios=$socios->where('ativo',$ativo);
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
            if($ativo!='A') $socios=$socios->where('ativo',$ativo);
        }


        $socios=$socios->paginate(24);

        return view('socios.list', compact('title', 'socios','filters'));
    }

    public function create()
    {
        $title = 'Inserir novo sócio';
        $socio = new User();

        return view('socios.add', compact('title', 'socio'));
    }

    public function store(StoreSocio $request)
    {
        if ($request->has('cancel')) {
            return redirect()->action('UserController@index');
        }

        $socio = $request->validated();

        $num_socio = User::max('num_socio');
        $socio['num_socio'] = ++$num_socio;
        $socio['password'] = Hash::make($socio['data_nascimento']);

        $user = User::create($socio);

        $foto = null;
        if (isset($socio['file_foto'])) {
            $path = $socio['file_foto']->storeAs('public/fotos', $user->id.'_pic.jpg');
            $foto = basename($path);
            $user->foto_url = $foto;
            $user->save();
        }

        $user->sendEmailVerificationNotification();

        return redirect()->action('UserController@index');
    }

    public function show($id)
    {
        // NAO E PARA IMPLEMENTAR
    }

    public function edit(User $socio)
    {
        $title = "Editar Sócio";

        return view('socios.edit', compact('title', 'socio'));
    }

    public function update(UpdateSocio $request, User $socio)
    {
        if ($request->has('cancel')) {
            return redirect()->action('UserController@index');
        }

        $socioEdit = $request->validated();

        $foto = null;
        if (isset($socioEdit['file_foto'])) {
            $path = $socioEdit['file_foto']->storeAs('public/fotos', $socio->id.'_pic.jpg');
            $foto = basename($path);
        }

        $keys = array_keys($socioEdit, null, true);

        foreach ($keys as $key) {
            unset($socioEdit[$key]);
        }

        $socio->fill($socioEdit);
        $socio->foto_url = $foto ?? $socio['file_foto'];

        $socio->save();

        return redirect()->action('UserController@index');
    }

    public function destroy(User $socio)
    {
        $socio->delete();

        return redirect()->action('UserController@index');
    }

    public function setQuota() 
    {

    }

    public function resetQuotas()
    {

    }

    public function desativarSemQuotas() 
    {

    }

    public function ativarSocio(User $socio)
    {

    }

    public function alterarPassword()
    {
        $title = 'Alterar a senha';

        return view('socios.alterPassword', compact('title'));
    }

    public function patchPassword(ChangePassword $request)
    {
        $request->validated();

        $user = Auth::user();

        $user->password = Hash::make($request->input('password'));
        $user->password_inicial = 0;

        $user->save();

        return redirect()->back();
    }

    public function sendReActivationEmail(User $socio)
    {
        $socio->sendEmailVerificationNotification();

        return redirect()->back();
    }

    public function licenca(User $piloto)
    {
        return response()->file(storage_path("app/docs_piloto/licenca_$piloto->id.pdf", "licenca.pdf", [], null));
    }

    public function certificado(User $piloto)
    {
        return response()->file(storage_path("app/docs_piloto/certificado_$piloto->id.pdf", "certificado.pdf", [], null));
    }
}
